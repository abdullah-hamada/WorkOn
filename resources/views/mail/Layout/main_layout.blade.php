<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
@include('mail.Layout.header')
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

    @include('mail.Layout.email_header_image')
    @include('mail.Layout.email_content_image')
    @yield('content')
    @include('mail.Layout.social_media')
    @include('mail.Layout.footer')
    </tbody>
</table>
<!--[if mso]></div><![endif]-->
<!--[if IE]></div><![endif]-->
</body>
</html>
