@extends('mail.Layout.main_layout')
@section('content')
    <tr>
        <td style="padding:20px 20px">
            <table width="100%" style="border-spacing: 0px;width:100%;margin-bottom: 10px;">
                <tbody>
                <tr>
                    <td dir="rtl" style="direction: rtl;text-align: right">
                        😊 نعلمكم بانه تم طلب خدمة (
                        {{$data['service_name']}}
                        )
                        التابعة  للشريك(
                        {{$data['partner']->name}}
                        )
                        <br>
                        📌يمكنكم الاطلاع على التفاصيل من خلال الرابط التالي:
                        @if($role=='admin')
                            <a style="text-decoration: none" target="_blank"
                               href="{{config('app.url') .'admin/partner/service_orders'}}">انقر هنا</a>
                        @elseif($role =='partner')
                            <a style="text-decoration: none" target="_blank"
                               href="{{config('app.url') .'dashboard/partner/service_orders'}}">انقر هنا</a>
                        @else
                            <a style="text-decoration: none" target="_blank"
                               href="{{config('app.url') .'dashboard/user/service_orders'}}">انقر هنا</a>

                        @endif
                        <br>
                        🌟 نتمنى لك كل التوفيق
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
@endsection
