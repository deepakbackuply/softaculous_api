## Staging an installation via Softaculous API guide

This document explains how to create staging installation of the installed script using Softaculous API.


## via cURL
```php
curl -d "softsubmit=1" -d "softdomain=domain.com" -d "softdirectory=wp" -d "softdb=wpdb" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=staging&insid=26_12345&api=json"
```

## via PHP script

```php
<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=staging'.
      '&insid=26_12345';

$post = array('softsubmit' => '1',
              'softdomain' => 'domain.com', // Must be a valid Domain
              'softdirectory' => 'wp', // Keep empty to install in Web Root
              'softdb' => 'wpdb'
);

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
 
// Done ?
if(!empty($res['done'])){

	echo 'Staging was successfully created. URL to Installation Staging installation : '.$res['__settings']['softurl'];

// Error
}else{

	echo 'Some error occured';
	print_r($res['error']);

}

// Print the entire output just incase !
print_r($res);

?>

```
### Expected output of $resp
```php
Staging was successfully created. URL to Installation Staging installation : http://domain.com/wpstaging
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done_msg] => Staging has been pushed in background
    [insid] => 
    [done] => ARkhCrgmhkJi3vKtJMMfVGUwmpXG
    [userins] => Array
        (
            [sid] => 26
            [ver] => 6.9
            [itime] => 1765348869
            [softpath] => /home/user/public_html
            [softurl] => https://domain.com
            [admin_folder] => wp-admin/
            [site_name] => My Blog
            [softdomain] => domain.com
            [softdb] => wp248
            [softdbuser] => wp248
            [softdbhost] => localhost
            [softdbpass] => *********
            [dbcreated] => 1
            [dbprefix] => wpod_
            [fileindex] => Array ............

```

## Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | staging   | The value should be “staging” for softaculous to perform the action of staging an installation.   |
| insid    | 26_12345   | Installation ID of the installation that you want to create staging copy for. It can be fetched from List Installed Script  |
| **Post** |
| softsubmit    | 1   | This will trigger the Staging  |
| softdomain    | domain.com   | This is the domain on which you wish to create the staging |
| softdirectory    | wp   | 	This is the sub-directory to create the staging. Leave it blank to create staging in root of the domain  |
| softdb    | wp123   | This is the database name for the created staging installation. If the script does not require database you can leave this blank.  |
