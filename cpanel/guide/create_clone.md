## Installation clone using Softaculous API Guide

This guide explains how to clone an installation using Softaculous API.


### via cURL
```php
curl -d "softsubmit=1" -d "softdomain=example.com" -d "softdirectory=wp" -d "softdb=wpdb" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=sclone&insid=26_12345&api=json"
```

### via PHP script

```php

<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=sclone'.
			'&insid=26_12345';

$post = array('softsubmit' => '1',
              'softdomain' => 'example.com', // Must be a valid Domain
              'softdirectory' => 'wp', // Keep empty to install in Web Root
              'softdb' => 'wpdb'
);

// Set the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,5);
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

	echo 'Cloned successfully. URL to Installation cloned installation : '.$res['__settings']['softurl'];

// Error
}else{

	echo 'Some error occured';
	print_r($res['error']);

}

// Print the entire output just incase !
print_r($res);

?>
```
### Expected response
```php
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done_msg] => Clone has been pushed in background
    [insid] => 
    [done] => mOxKdQYhl9XiYwsQHDltNBcuYVzq
    [userins] => Array
        (
            [sid] => 26
            [ver] => 6.9
            [itime] => 1765277380
            [softpath] => /home/user/public_html
            [softurl] => https://domain.com
            [adminurl] => wp-admin/
            [disable_wp_cron] => 
            [admin_username] => admin
            [admin_email] => admin@domain.com
            [softdomain] => domain.com
            [softdb] => wp586
            [softdbuser] => wp586
            [softdbhost] => localhost
            [softdbpass] => **********
            [dbprefix] => wp9b_
            [dbcreated] => 1
            [fileindex] => Array ..................      

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | sclone   | The value should be “sclone” for Softaculous to perform the action of cloning an installation. |
| insid    | 26_12345 (Installation ID)   | Installation ID of the installed script. It can be fetched from List Installed Script   |
| **POST**    |
| softsubmit  | 1   | This will trigger the upgrade   |
| softdomain | domain.com	| 	This is the domain on which you wish to clone the installation  |
| softdirectory  | wp   | This is the sub-directory to clone the installation in. Leave it blank to clone in root of the domain   |
| softdb  | wp123   | 	This is the database name for the cloned installation. If the script does not require database you can leave this blank.   |
