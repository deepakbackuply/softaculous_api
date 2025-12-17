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
| act    | upgrade   | The value should be “upgrade” for softaculous to perform the action of upgrading an installation.   |
| insid    | 26_12345   | The value should be “SID” for softaculous to perform the action of installing a software. You can find the list of sid’s [here](https://api.softaculous.com/scripts.php?in=serialize)   |
| **POST**    |
| softsubmit  | 1   | This will trigger the upgrade   |
