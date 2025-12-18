## Auto sign-on on installation admin dashboard using Softaculous API Guide
This guide explains how to automatically sign in to the installation’s admin dashboard using the Softaculous API.

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
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
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
    [sign_on_url] => https://domain.com/sapp-wp-signon.php?pass=o0pqxirdps6ugpdtow517lramd
    [timenow] => 1766057173
    [time_taken] => 0.094
)
```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act  | sign_on  | The value should be “sign_on” to perform the action to get the sign on URL. |
| insid  | 26_12345 | The installation ID that you want to edit. |
| autoid  | abcdefghijklmnopqrstuvwxyz0123456789 | This must be any 32 character random string. |
