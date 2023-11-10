@extends('mail.Layout.main_layout')

@section('content')

    <tr>
        <td style="padding:20px 20px">
            <table width="100%" style="border-spacing: 0px;width:100%;margin-bottom: 10px;">
                <tbody>

                <tr>
                <td dir="rtl" style="direction: rtl;text-align: right">

                    👋  السيد   ( {{$data['name']}} )
                    عضو مجتمع WorkNet المحترم
                    <br>
                    📌
                    نود إبلاغكم يتعاون جديد ومميز يضاف لقائمة شركاء منصة WorkNet شريكنا الجديد
                    <br>

                    📌يمكنكم الاطلاع على بيانات الشريك ({{$data['partner_order']->company_name}}) من خلال الرابط التالي:
                         <a style="text-decoration: none" target="_blank"
                           href="{{$data['partner_page_link']}}">انقر هنا</a>
                    <br>
                    📌يمكنكم الاطلاع على   قائمة شركاء منصة WorkNet   من خلال الرابط التالي:
                    <a style="text-decoration: none" target="_blank"
                       href="{{$data['partners_page_link']}}">انقر هنا</a>
                    <br>
                           🌟  نتمنى لك كل التوفيق
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
@endsection
