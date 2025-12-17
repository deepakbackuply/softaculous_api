# Install Script via API

This document explains how to upgrade an installation using Softaculous API.


## via cURL
```php
curl -d "softsubmit=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=upgrade&insid=26_12345&api=json"
```

## via PHP script

```php
<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=upgrade'.
      		'&insid=26_12345';

$post = array('softsubmit' => '1');

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
 
// Done ?
if(!empty($res['done'])){

	// There might be some task that the user has to perform
	if(!empty($res['setupcontinue'])){

		echo 'Please visit the following URL to complete upgrade : '.$res['setupcontinue'];	

	// It upgraded
	}else{

		echo 'Upgraded successfully. URL to Installation : '.$res['__settings']['softurl'];	

	}

// Error
}else{

	echo 'Some error occured';
	print_r($res['error']);

}

// Print the entire output just incase !
print_r($res);
```
### Expected output of $resp
```php

Upgraded successfully. URL to Installation : https://domain.com
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done] => 1
    [software] => Array
        (
            [name] => WordPress
            [softname] => wp
            [desc] => WordPress is a state-of-the-art publishing platform with a focus on aesthetics, web standards, and usability.
            [ins] => 1
            [cat] => blogs
            [type] => php
            [ver] => 6.9
            [pre_down] => 1
            [path] => /var/softaculous/wp
            [spacereq] => 77628622
            [adminurl] => wp-admin/
            [update_plugins] => 1
            [update_themes] => 1
        )

    [soft] => 26
    [info] => Array ...........

```

## Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | upgrade   | The value should be “upgrade” for softaculous to perform the action of upgrading an installation.   |
| insid    | 26_12345   | The installation ID that you want to upgrade.  |
| **POST**    |
| softsubmit  | 1   | This will trigger the upgrade   |
