## Import an installation using Softaculous API guide

This guide explains how to import an installation using Softaculous API.


### via cURL
```php
curl -d "softsubmit=1" -d "softdomain=example.com" -d "softdirectory=wp" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=import&soft=26&api=json"
```

### via PHP script

```php
<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
         '&api=serialize'.
         '&act=import'.
         '&soft=26';

$post = array('softsubmit' => 1,
             'softdomain' => 'example.com',
             'softdirectory' => 'wp');

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
$res = unserialize($resp);

print_r($res);

?>

```
### Expected response
```php
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done_msg] => Import has been pushed in background
    [insid] => 
    [done] => cMEBlvDzEN2zPjowzZT6fzeLWm1
    [info] => Array
         (
            [overview] => ...............  

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | import   | The value should be “import” for softaculous to perform the action of staging an installation.   |
| soft    | 26 (26 is the Script ID of WordPress)   | The value should be “SID” for softaculous to perform the action of installing a software. You can find the list of sid’s [here](https://api.softaculous.com/scripts.php?in=serialize)  |
| **Post** |
| softdomain    | domain.com   | 	This will be the domain where your script is installed. Domain should be without http:// or https:// |
| softdirectory    | wp   | 	(OPTIONAL) This will be the directory under the domain where your script is installed. Leave this blank if the script is installed in the root of domain.  |
| softsubmit    | 1  | This will trigger the import function.  |
