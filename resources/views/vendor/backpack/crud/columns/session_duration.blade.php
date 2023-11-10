<?php
if (isset($entry->logout_date) && !empty($entry->logout_date)) {
    $last_logout = \Carbon\Carbon::parse($entry->last_logout);
    $last_login = \Carbon\Carbon::parse($entry->last_login);
    echo $last_logout->diffInMinutes($last_login) . 'دقيقة';
}

