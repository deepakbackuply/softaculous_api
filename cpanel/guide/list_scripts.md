# Install Script via API

This document explains how to fetch the script list using Softaculous API.


## via cURL
```php
curl "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=home&api=json"
```

## via PHP script

```php
<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&act=home&api=serialize';

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

// Unserialize data
$res = unserialize($resp);

// The Installed scripts list is in the array key 'iscripts'
print_r($res['iscripts']);

?>
```
### Expected output of $resp
```php
Array
(
    [26] => Array
        (
            [name] => WordPress
            [softname] => wp
            [desc] => WordPress is a state-of-the-art publishing platform with a focus on aesthetics, web standards, and usability.
            [ins] => 1
            [cat] => blogs
            [type] => php
            [ver] => 6.9
            [pre_down] => 1
        )

    [18] => Array
        (
            [name] => Joomla 2.5
            [softname] => joomla16
            [desc] => Joomla is an award-winning CMS, which enables you to build Web sites and powerful online applications
            [ins] => 1
            [cat] => cms
            [type] => php
            [ver] => 2.5.28
        )

    [72] => Array
        (
            [name] => PrestaShop 1.6
            [softname] => presta
            [desc] => PrestaShop is professional e-Commerce shopping cart software
            [ins] => 1
            [cat] => ecommerce
            [type] => php
            [ver] => 1.6.1.24
        )............
            

```

## Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | 	blank or any   | Any act will do as this is available everywhere.  |

