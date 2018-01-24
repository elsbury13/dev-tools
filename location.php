<?php
/*
 * Function to insert and update web stats
 * e.g. user agent, web page address, IP, location
 */
function webStats()
{
    return [
        'ip' => $_SERVER["REMOTE_ADDR"],
        'page' => $_SERVER['PHP_SELF'],
        'queryString' => $_SERVER['QUERY_STRING'],
        'location' => getUserIP(),
        'userAgent' => $_SERVER['HTTP_USER_AGENT'],
    ];
}

function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        return $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        return $forward;
    } else {
        return $remote;
    }
}

echo 'IP is: ' . webStats()['ip'] .
'<br>Page is:' . webStats()['page'] .
'<br>Location is: ' . webStats()['location'] .
'<br>Query String is: ' . webStats()['queryString'] .
'<br>User Agent is ' . webStats()['userAgent'];
