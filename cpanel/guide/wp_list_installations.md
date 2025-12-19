## List WordPress Installations using Softaculous API Guide
This guide explains how to list WordPress installations using Softaculous API.

### via cURL
```php

curl "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=wordpress&api=json"

```

### via PHP script

```php

<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
             '&api=serialize'.
             '&act=wordpress';

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
     
     print_r($res);

}

?>
```
### Expected response
```php
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done] => Plugins(s) and themes(s) removed
    [sets] => Array
        (
            [SET-NAME] => Array
                (
                    [enduser_set] => 1
                    [plugins] => Array
                        (
                        )
                    [themes] => Array
                        (
                            [popularfx] => PopularFX
                        )
                )
        )

    [timenow] => 1766129375
    [time_taken] => 0.076
)
```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication  | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act  | wordpress  | The value should be “wordpress” to perform the action of listing WordPress installations. |
