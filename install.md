# Softaculous Install Script Guide

This document explains how to create a basic Softaculous-style installation handler.

---

## Required Parameters

| Parameter | Description |
|----------|-------------|
| `domain` | Domain name where installation will occur |
| `admin`  | Admin username |
| `pass`   | Admin password |

Example request: https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?&act=home&api=serialize


---
## CuRL
curl "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=home&api=json"

## PHP Installation Script(via API)

Below is the full code you can use inside `install.php` on your server:

```php
<?php

$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&act=home&api=serialize';

// Set the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $time);
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


