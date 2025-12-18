## Get script info using Softaculous API Guide

This document explains how to get script info using Softaculous API.


### via cURL
```php
curl "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=software&soft=26&giveinfo=1&api=json"
```

### via PHP script

```php

<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=software'.
			'&soft=26'.
			'&giveinfo=1';


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
 
print_r($res);
print_r($res['info']['overview']); // will have overview of the script (in HTML format)
print_r($res['info']['features']); // will have features list of the script (in HTML format)
print_r($res['info']['demo']); // will have the link to demo of the script
print_r($res['info']['ratings']); // will have the link to ratings page of the script
print_r($res['info']['support']); // will have the link to script vendor support page
print_r($res['info']['release_date']); // will have the release date of the current version of the script
print_r($res['settings']); // will have an array of the list of fields that the script will require, e.g. site_name, site_desc, language, etc
print_r($res['dbtype']); // if the value is not empty it means the script requires a database, if the value is empty it means that the script does not require a database
print_r($res['cron']); // if the value is not empty it means the script requires a CRON JOB, if the value is empty it means that the script does not require a CRON JOB
print_r($res['datadir']); // if the value is not empty it means the script requires a data directory, if the value is empty it means that the script does not require a data directory

?>
```
### Expected response
```php
Array
(
    [title] => Softaculous - Powered by Softaculous
    [info] => Array
        (
            [overview] => WordPress is web software you can use to create a beautiful website or blog.
            [install] => 
            [features] => WordPress powers more than 23% of the web - a figure that rises every day. Everything from simple websites
            [demo] => http://www.softaculous.com/demos/WordPress
            [ratings] => http://www.softaculous.com/softwares/blogs/WordPress
            [support] => http://www.wordpress.org/
            [release_date] => 02-12-2025
            [mod] => 255
            [mod_files] => 1
            [import] => 1
        ) ...........
```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | software   | 	The value should be “installations” to perform the action of listing installations. |
| soft    | 26 (26 is the Script ID of WordPress)   | The value should be “SID” for softaculous to perform the action of installing a software. You can find the list of sid’s [here](https://api.softaculous.com/scripts.php?in=serialize)  |
| giveinfo  | 1   | Pass this value as 1 to get the information of the script (passed in the soft parameter)  |
