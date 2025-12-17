## Import an installation using Softaculous API guide

This document explains how to import an installation using Softaculous API.


### via cURL
```php
curl -d "softsubmit=1" -d "approved[]=cbpny97zd5kcsk4coo8gws084" -d "approved[]=dxw755lmeb4s4cw40o8o8kk44" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=sync&api=json"
```

### via PHP script

```php
<?php

//The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
   '&api=serialize'.
   '&act=sync';
$post = array( 'softsubmit' => 1, 
               'approved' =>     array('cbpny97zd5kcsk4coo8gws084','dxw755lmeb4s4cw40o8o8kk44'));

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
| act    | sync   | The value should be “sync” to perform the action of importing all installations.   |
| **Post** |
| approved    | array(‘cbpny97zd5kcsk4coo8gws084′,’dxw755lmeb4s4cw40o8o8kk44’)   | 	This will be the array that you’ll have to post in which you’ll have to pass all the installations key that you want to import(You will get this key in list array of particular script). |
| softsubmit    | 1  | This will trigger the import function to import all installations from other installer.  |
