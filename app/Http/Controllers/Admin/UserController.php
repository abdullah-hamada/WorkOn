<?php

namespace App\Http\Controllers\Admin;

use App\Exports\job\OtherJobReportExcelExport;
use App\Exports\user\CourseExcelExport;
use App\Exports\user\UserExcelExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Category;
use App\Models\Country;
use App\Models\Role;
use App\Models\User;
use App\Models\UserSubscribe;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        return Inertia::render('views/admin/Users/Index', [
            'users' => User::with(['roles', 'country:id,name_ar', 'category:id,name_ar'])->withCount('courses')->orderBy('id', 'desc')
                ->get(),
        ]);
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'whatsapp_number' => $request->whatsapp_number,
            'email_verified_at' => Carbon::now(),
            'country_id' => $request->country_id,
            'category_id' => $request->category_id,
            'status' => '1',
        ]);
        $role = Role::find($request->role_id);
        $user->assignRole($role->name);
        if ($user) {
            return redirect('/admin/users')->with('success', 'تم الحفظ بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }

    public function create()
    {
        return Inertia::render('views/admin/Users/Create', [
            'roles' => Role::query()->orderBy('id', 'desc')->get(),
            'categories' => Category::all(),
            'countries' => Country::query()->select('id', 'name_ar')->get()
        ]);
    }

    public function edit($id)
    {
        $user = User::with('roles')->where('id', $id)
            ->select('id', 'name', 'email', 'whatsapp_number', 'country_id', 'category_id')
            ->first();
        if (!$user) {
            abort(404);
        }
        return Inertia::render('views/admin/Users/Edit', [
            'user' => $user,
            'roles' => Role::query()->orderBy('id', 'desc')->get(),
            'categories' => Category::all(),
            'countries' => Country::query()->select('id', 'name_ar')->get()

        ]);
    }

    public function show($id)
    {

        $user = User::with(['country:id,name_ar', 'category:id,name_ar', 'courses:id,title'])->withCount('courses')->where('id', $id)
            ->first();
        if (!$user) {
            abort(404);
        }
        return Inertia::render('views/admin/Users/ShowInfo', [
            'user' => $user,
            'timezone' => getTimeZone()
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (UserSubscribe::where('user_id', $id)->first()) {
            return redirect()->back()->with('success', 'لا يمكن حذف المستخدم لاشتراكه في دورة  معين');
        }
        $status = $user->delete();
        if ($status) {
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        }
    }

    public function change_status($id)
    {
        $user = User::find($id);
        $status = $user->update([
            'status' => $user->status == 0 ? 1 : 0
        ]);
        if ($status) {
            return redirect()->back()->with('success', 'تم تحديث الحالة بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }

    public function update(UserRequest $request, $id)
    {
        $data = [
            'name' => $request->username,
            'email' => $request->email,
            'whatsapp_number' => $request->whatsapp_number,
            'country_id' => $request->country_id,
            'category_id' => $request->category_id,
        ];
        if (isset($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
        $user = User::find($id);
        if (!$user) {
            abort(404);
        }
        $status = $user->update($data);
        $role = Role::find($request->role_id);
        $user->assignRole($role->name);
        if ($status) {
            return redirect('/admin/users')->with('success', 'تم التحديث بنجاح');
        } else {
            return redirect()->back()->with('error', 'حدث خطا ما');
        }
    }

    public function export_users()
    {
        return Excel::download(new UserExcelExport(), 'users.xlsx');

    }

}
