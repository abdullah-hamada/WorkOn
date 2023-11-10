
<?php

if(isset($entry->logout_date) && !empty($entry->logout_date)){
    $logout_date = \Carbon\Carbon::parse($entry->logout_date);
    $login_date=\Carbon\Carbon::parse($entry->login_date) ;
    echo  $logout_date->diffInMinutes($login_date)   . 'دقيقة';
}


