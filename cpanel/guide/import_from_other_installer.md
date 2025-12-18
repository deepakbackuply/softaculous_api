## Import an installation using Softaculous API guide
This guide explains how to import an installation using Softaculous API.

### via cURL
```php
curl "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=sync&api=json"
```

### via PHP script

```php

//First you will need to make API call without post parameter to get all list of installations fetched from other installer.

<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
           '&api=serialize'.
           '&act=sync';

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
[title] => Softaculous - Softaculous - Import
[info] => 
[notes] => 
[list] => Array
 (
  [26] => Array
   (
	[cbpny97zd5kcsk4coo8gws084] => Array
	  (
	   [base] => cbpny97zd5kcsk4coo8gws084
	   [path] => /home/soft/.appdata/current/cbpny97zd5kcsk4coo8gws084
	   [url] => http://www.test.nuftp.com/insat2
	   [domain] => test.nuftp.com
	   [dir] => insat2
	   [softproto] => http://www.
	  )
	[dxw755lmeb4s4cw40o8o8kk44] => Array
	 (
	  [base] => dxw755lmeb4s4cw40o8o8kk44
	  [path] => /home/soft/.appdata/current/dxw755lmeb4s4cw40o8o8kk44
	  [url] => http://www.test.nuftp.com/testinstallatr
	  [domain] => test.nuftp.com
	  [dir] => testinstallatr
	  [softproto] => http://www.
	 )
    )
  )
[timenow] => 1578496674
[time_taken] => 0.038
)

```
#### You will need to pass the all list installations keys that you want to import as you can see in response you will get the list array in which you will find the installations keys for particular scripts key, here we shown example of wordpress(26).

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
               'approved' => array('cbpny97zd5kcsk4coo8gws084','dxw755lmeb4s4cw40o8o8kk44'));

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
### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | sync   | The value should be “sync” to perform the action of importing all installations.   |
| **Post** |
| approved    | array(‘cbpny97zd5kcsk4coo8gws084′,’dxw755lmeb4s4cw40o8o8kk44’)   | 	This will be the array that you’ll have to post in which you’ll have to pass all the installations key that you want to import(You will get this key in list array of particular script). |
| softsubmit    | 1  | This will trigger the import function to import all installations from other installer.  |
