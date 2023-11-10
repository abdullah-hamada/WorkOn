@extends('mail.Layout.main_layout')
@section('content')
    <tr>
        <td style="padding:20px 20px">
            <table width="100%" style="border-spacing: 0px;width:100%;margin-bottom: 10px;">
                <tbody>
                <tr>
                    <td style="text-align: center">
                        👋  شريكنا العزيز ( {{$data['name']}} )
                    </td>
                </tr>
                <tr>
                <td dir="rtl" style="direction: rtl;text-align: right">
                    <br>
                         📌بسبب نقص أو خطأ في البيانات التي قمتم بتقديمها نأسف بعدم قبول طلب الشراكة في منصة WorkNet
                    نرجو منكم تحديث البيانات من خلال تسجيل الدخول عبر الرابط التالي: :
                         <a style="text-decoration: none" target="_blank"
                           href="{{$data['link']}}">انقر هنا</a>
                    <br>   <br>

                          🌟  نتمنى لك كل التوفيق
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
@endsection
