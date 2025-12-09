# List all installations via Softaculous API

This document explains how to install a script using Softaculous API.


## via CuRL
```php
curl "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=installations&api=json"
```

## via PHP script

```php
<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
       '&api=serialize'.
       '&act=installations';


// Set the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $time);
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
### Expected output of $resp
```php
Array
(
    [title] => Softaculous 
    [done] => 1
    [info] => Array
        (
            [overview] => WordPress is web software you can use to create a beautiful website or blog. We like to say that WordPress is both free and priceless at the same time.
            [install] => 
            [features] => WordPress powers more than 23% of the web - a figure that rises every day. Everything from simple websites, to blogs, to complex portals and enterprise websites, and even applications, are built with WordPress.
            [demo] => http://www.softaculous.com/demos/WordPress
            [ratings] => http://www.softaculous.com/softwares/blogs/WordPress
            [support] => http://www.wordpress.org/
            [release_date] => 30-09-2025
            [mod] => 254
            [mod_files] => 
            [import] => 1
        )

    [settings] => Array
        (
            [Database Settings] => Array
                (
                    [dbprefix] => Array
                        (
                            [tag] => wp_
                            [head] => Table Prefix
                            [exp] => 
                            [handle] => 
                            [optional] => 1
                            [quick_install] => 
                            [minlen] => 
                            [orig_val] => wp_
                        )

                )
.........

```

## Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | installations   | The value should be “installations” to perform the action of listing installations.   |
| showupdates    | true   | (OPTIONAL) The value should be “true” if you want to list only installations that have an update available for softaculous to perform the action of listing installations.  |

