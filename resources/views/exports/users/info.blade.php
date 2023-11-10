<table border="1" style="max-width: 100%;">
    <thead>
    <tr style="background-color: #eeeeee">
        <th style="font-weight: bold; text-align: center">اسم المستخدم</th>
        <th style="font-weight: bold; text-align: center">البريد الالكتروني</th>
         <th style="font-weight: bold; text-align: center">رقم الواتس اب</th>
        <th style="font-weight: bold; text-align: center">الدولة</th>
        <th style="font-weight: bold; text-align: center">التخصص</th>
        <th style="font-weight: bold; text-align: center">الدور</th>
         <th style="font-weight: bold; text-align: center">الحالة  </th>
        <th style="font-weight: bold; text-align: center">تاريخ الاشتراك</th>
        <th style="font-weight: bold; text-align: center">عدد الدورات المشترك بها</th>
        <th style="font-weight: bold; text-align: center">  الدورات المشترك بها</th>

    </thead>
    <tbody>
    @foreach($users  as  $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->whatsapp_number }}</td>
            <td>{{ $user->country->name_ar }}</td>
            <td>{{ $user->category->name_ar }}</td>
            <td>{{ $user->roles[0]->name }}</td>
            <td>{{ $user->status == 0 ?  'مجمد'  : 'مفعل' }}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->courses_count }}</td>
            <td>

                @foreach($user->courses as $course)
                    <h4>{{$course->title}}</h4>

                @endforeach

            </td>


        </tr>
    @endforeach
    </tbody>
</table>
