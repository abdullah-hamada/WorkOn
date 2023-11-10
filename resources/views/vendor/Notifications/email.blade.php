<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
      xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <!--[if gte mso 9]>
    <xml>
    <o:OfficeDocumentSettings>
        <o:AllowPNG/>
        <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <!--[if !mso]><!-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--<![endif]-->
    <title></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap');

        * {
            box-sizing: border-box
        }

        .link {
            text-decoration: none;
            background-color: #FFF;
            display: inline-flex;
            box-shadow: 0px 0px 10px #0000001a;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
            margin: 0px 6px;
            transition: all .3s ease-in-out;
            color: #666666;
            text-align: center;
            border: 1px solid #e2e2e2;
        }

        .link img {
            margin: auto;
            max-height: 22px
        }

        @media (min-device-width: 1000px) {
            .table-main {
                width: 500px !important;
            }
        }

    </style>
</head>


<body class="clean-body u_body"
      style="margin: 0; -webkit-text-size-adjust: 100%; color: #000000;background-color: #f7f7f7;padding: 10px 0px;">

<!--[if IE]>
<div class="ie-container"><![endif]-->
<!--[if mso]>
<div class="mso-container"><![endif]-->

<table class="table-main"
       role="presentation"
       valign="top"
       border="0"
       cellspacing="0"
       cellpadding="0"
       align="center"
       width="100%"
       style="
        margin-left: auto;
        margin-right: auto;
        font-family: 'Roboto', sans-serif;
        width:100%;
        background-color: #fff
">
    <tbody>


    <tr>
        <td style="padding:10px 20px;border-bottom:1px solid rgb(207, 207, 207)">
            <table width="100%" style="border-spacing: 0px;width:100%">
                <tbody>
                <tr>
                    <td style="font-weight: bold;font-size:32pxtext-align:right" align="right">
                        <img src="{{asset('images/logo.jpg')}}"
                             style="height:45px;text-align: center">
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>


    <tr>
        <td style="padding:30px 20px 0">
            <table width="100%" style="border-spacing: 0px;width:100%">
                <tbody>
                <tr>
                    <td style="text-align:center;font-weight: bold;font-size:32px">
                        <img src="{{asset('images/event_email_image.jpg')}}"
                             alt="" style="max-width:100%;margin:auto">
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:20px 20px 0">
            <table width="100%" style="border-spacing: 0px;width:100%;text-align:center">
                <tbody>
                <tr>
                    <td class="font-size-16"
                        style="text-align:center;font-weight: bold;font-size:24px;color:#2A2A2A;font-family:'Roboto'"
                        align="center">
                        {{--                        Welcom To Kafu Platform--}}
                        {{ $actionText }}
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding:20px 20px">
            <table width="100%" style="border-spacing: 0px;width:100%;margin-bottom: 10px;">
                <tbody>


                         <tr>

                            <td style="text-align:center;color:#707070;font-family:'Roboto'">
                                @foreach ($introLines as $line)
                                    {{ $line }}

                                @endforeach

                            </td>
                        </tr>

                 </tbody>
            </table>
        </td>
    </tr>

    <tr>
        <td style="padding-bottom:20px">
            <table width="100%" style="border-spacing: 0px;width:100%;margin-bottom:20px">
                <tbody>
                     <tr>
                        <td style="text-align:center;color:#f7f7f7">
                            <a href="{{$actionUrl}}"
                               style="text-decoration: none;cursor: pointer;cursor: pointer;display: inline-block; padding: 12px 34px; background-color: #1b56aa; border-radius: 5px; color: #fff; font-size: 16px; font-weight: 500;font-family:'Roboto'">
                                {{ $actionText }}
                            </a>
                         </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td style="padding-bottom:20px">
            <table width="100%" style="border-spacing: 0px;width:100%;margin-bottom:20px">
                <tbody>
                <tr>
                    <td style="text-align:center;color:#f7f7f7">
                        <a class="link" target="_blank" href="https://www.facebook.com/gopalCenter/"><img
                                    src="https://cdn-icons-png.flaticon.com/512/3128/3128304.png"
                                    alt=""></a>

                        <a class="link" target="_blank" href=""><img
                                    src="https://cdn-icons-png.flaticon.com/512/2111/2111499.png"
                                    alt=""></a>
                        <a class="link" target="_blank" href="https://www.instagram.com/gopalcenter/"><img
                                    src="https://cdn-icons-png.flaticon.com/512/174/174855.png" alt=""></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>

    <tr>
        <td style="padding:15px 20px;border-top:1px solid rgb(207, 207, 207)">
            <table width="100%" style="border-spacing: 0px;width:100%">
                <tbody>
                <tr>
                    <td style="text-align:center;color:#707070;font-family:'Roboto'">
                        مجتمع Work Net
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>

    </tbody>
</table>


<!--[if mso]></div><![endif]-->
<!--[if IE]></div><![endif]-->
</body>
</html>
