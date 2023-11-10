@extends('mail.Layout.main_layout')
@section('content')
    <tr>
        <td style="padding:20px 20px">
            <table width="100%" style="border-spacing: 0px;width:100%;margin-bottom: 10px;">
                <tbody>
                <tr>
                    <td style="text-align: center">
                         👋  مرحبا    ( {{$data['user_name']}} )
                    </td>
                </tr>
                <tr>
                <td dir="rtl" style="direction: rtl;text-align: right">
                    😊   تم تسجيل طلب شراكة جديد من قبل شركة ({{$data['company_name']}}    ) ويحتاج للتدقيق وفي انتظار الموافقة أو الرفض
                    <br>
                        📌لإكمال الإجراء في لوحة التحكم من خلال الرابط التالي :
                         <a style="text-decoration: none" target="_blank"
                           href="{{$data['link']}}">انقر هنا</a>
                    <br>
                     </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
@endsection
