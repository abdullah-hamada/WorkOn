<table border="1" style="max-width: 100%;">
    <thead>
    <tr>
        <td></td>
        <th style="font-weight: bold; text-align: center">
           المشتركين في دورة
            {{$course_title}} </th>
        <td></td>
    </tr>

    <tr style="background-color: #eeeeee">
        <th style="font-weight: bold; text-align: center">اسم المستخدم</th>
        <th style="font-weight: bold; text-align: center">البريد الالكتروني</th>
         <th style="font-weight: bold; text-align: center">رقم الواتس اب</th>
        <th style="font-weight: bold; text-align: center">الدولة</th>
        <th style="font-weight: bold; text-align: center">التخصص</th>
          <th style="font-weight: bold; text-align: center">الحالة  </th>
        <th style="font-weight: bold; text-align: center">تاريخ الاشتراك</th>
        <th style="font-weight: bold; text-align: center">المبلغ المدفوع  </th>
    </thead>
    <tbody>
    @foreach($users  as  $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->whatsapp_number }}</td>
            <td>{{ $user->country->name_ar }}</td>
            <td>{{ $user->category->name_ar }}</td>
            <td>{{ $user->status == 0 ?  'مجمد'  : 'مفعل' }}</td>
            <td>{{ $user->pivot->created_at }}</td>
            @if($user->pivot->amount)
            <td>{{ $user->pivot->amount  }}  دولار </td>
            @else
            مجاني
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
