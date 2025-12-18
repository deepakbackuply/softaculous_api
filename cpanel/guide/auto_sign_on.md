## Auto sign on on installation admin dashboard using Softaculous API Guide

This document explains how to auto sign on the installation admin dashboard using Softaculous API.


### via cURL
```php
curl "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=sign_on&insid=26_12345&autoid=abcdefghijklmnopqrstuvwxyz0123456789&api=json"
```

### via PHP script

```php

<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
    			'&api=serialize'.
    			'&act=sign_on'.
    			'&insid=26_12345'.
    			'&autoid=abcdefghijklmnopqrstuvwxyz0123456789';

// Set the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $time);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Turn off the server and peer verification (TrustManager Concept).
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
 
// Get response from the server.
$resp = curl_exec($ch);

?>
```
#### On using this API, you will get the sign_on_url, upon accessing which the user will be logged in to the admin panel of the script. You can use the same URL to redirect the user as shown here:
```php
$op = unserialize($resp);
header('Location: '.$op['sign_on_url']);
```
### Expected response
```php
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done_msg] => Your backup is being created in background. You will be notified by email once its completed. You can track the backup process from the  Task List page.
Your installation URL : https://domain.com
    [done] => TDpa5nojrXBWxcIcOBvNYF2e7X9
    [userins] => Array
        (
            [sid] => 26
            [ver] => 6.9
            [itime] => 1765257816
            [softpath] => /home/user/public_html
            [softurl] => https://domain.com
            [adminurl] => wp-admin/
            [disable_wp_cron] => 
            [admin_username] => admin
            [admin_email] => admin@domain.com
            [softdomain] => domain.com
            [softdb] => user_wp152
            [softdbuser] => user_wp152
            [softdbhost] => localhost
            [softdbpass] => pp@683p8S.
            [dbprefix] => wpom_
            [dbcreated] => 1
            [fileindex] => Array .................

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act  | sign_on  | The value should be “sign_on” to perform the action to get the sign on URL. |
| insid  | 26_12345 | The installation ID that you want to edit. |
| autoid  | abcdefghijklmnopqrstuvwxyz0123456789 | This must be any 32 character random string. |
