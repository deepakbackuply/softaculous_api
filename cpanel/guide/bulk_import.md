## Import all installations to Softaculous using Softaculous API guide

This document explains how to import all your installations to Softaculous. 

### via cURL
```php
curl -d "import_all=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=sync&api=json"
```

### via PHP script

```php
<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
       '&api=serialize'.
       '&act=sync';

$post = array('import_all' => 1);

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
$res = unserialize($resp);

print_r($res);

?>

```
### Expected output of $resp
```php
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done] => 1
    [info] => 
    [notes] => 
    [list] => Array
        (
            [26] => Array
                (
                    [26_12345] => Array
                        (
                            [url] => https://domain.com/wpst
                            [synced] => 1
                        )

                )

        )

    [timenow] => 1765977462
    [time_taken] => 0.143
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | sync   | The value should be “sync” to perform the action of importing all installations.   |
| **Post** |
| import_all   | 1   | This will trigger the import function to import all manual installations. |
