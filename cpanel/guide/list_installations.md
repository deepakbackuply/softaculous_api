## List all installations using Softaculous API Guide
This guide explains how to fetch all installation list using Softaculous API.

### via cURL
```php
curl "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=installations&api=json"
```

### via PHP script

```php

<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
         '&api=serialize'.
         '&act=installations';


// Set the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Turn off the server and peer verification (TrustManager Concept).
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

if(!empty($post)){
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
}
 
// Get response from the server.
$resp = curl_exec($ch);
 
// The response will hold a string as per the API response method. In this case its PHP Serialize
$res = unserialize($resp);
 
if(!empty($res['error'])){

     // Error
     echo 'Some error occurred';
     print_r($res['error']);

}else{
     
     print_r($res['installations']);

}

?>
```
### Expected response
```php
Array
(
    [543] => Array
        (
            [543_12345] => Array
                (
                    [sid] => 543
                    [ver] => 11.2.10
                    [itime] => 1766039576
                    [softpath] => /home/user/public_html/moodle
                    [softurl] => https://domain.com/moodle
                    [adminurl] => user/login
                    [softdomain] => domain.com
                    [softdb] => mood530
                    [softdbuser] => mood530
                    [softdbhost] => localhost
                    [softdbpass] => ********
                    [dbprefix] => drvt_
                    [dbcreated] => 1
                    [cron_time] => 43,5,*,*,*
                    [cron_command] => d2dldCAtTyAtICkZXYvbnVsbA==
                    [fileindex] => Array()
                    [admin_username] => admin
                    [admin_email] => admin@script.nuftp.com
                    [site_name] => My Drupal
                    [insid] => 543_12345
                    [display_softdbpass] => 7)V]1S8Mqp
                    [script_name] => Drupal Core
                )

        )

    [26] => Array
        (
            [26_45678] => Array
                (
                    [sid] => 26
                    [ver] => 6.9
                    [itime] => 1766039749
                    [softpath] => /home/user/public_html/wp
                    [softurl] => https://domain.com/wp
                    [adminurl] => wp-admin/
                    [disable_wp_cron] => 
                    [admin_username] => admin
                    [admin_email] => admin@domain.com
                    [softdomain] => domain.com
                    [softdb] => wp118
                    [softdbuser] => wp118
                    [softdbhost] => localhost
                    [softdbpass] => *********
                    [dbprefix] => wphh_
                    [dbcreated] => 1
                    [fileindex] => Array()
                    [site_name] => My Blog
                    [insid] => 26_45678
                    [display_softdbpass] => *******
                    [script_name] => WordPress
                )

        )

)


```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | installations   | The value should be “installations” to perform the action of listing installations. |
| showupdates    | true | (OPTIONAL) The value should be “true” if you want to list only installations that have an update available for softaculous to perform the action of listing installations.  |
