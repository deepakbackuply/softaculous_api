## Update installation version in Softaculous record using Softaculous API guide

This document explains how to update the installation version in Softaculous records using Softaculous API.


## via cURL
```php
curl "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=editdetail&insid=26_12345&updateversion=1&api=json"
```

## via PHP script

```php
<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=editdetail'.
			'&insid=26_12345'.
			'&updateversion=1';


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

	print_r($res);

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
Array
(
    [title] => Softaculous - Powered by Softaculous
    [settings] => Array
        (
            [Admin Account] => Array
                (
                    [admin_username] => Array
                        (
                            [tag] => 
                            [head] => Admin Username
                            [exp] => The username/email for which you want to change the password. Leave blank if you do not want to reset the password
                            [handle] => 
                            [optional] => 1
                            [quick_install] => 1
                            [minlen] => 
                        )

                    [admin_pass] => Array
                        (
                            [tag] => 
                            [head] => Admin Password
                            [exp] => New password. Leave blank if you do not want to reset the password
                            [handle] => 
                            [optional] => 1
                            [quick_install] => 1
                            [minlen] => 
                        )

                    [signon_username] => Array ............

```

## Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    |editdetail   | The value should be “editdetail” for softaculous to perform the action of editing an installation.   |
| insid    | 26_12345   | The installation ID that you want to edit.   |
| updateversion    | 1   | The value should be 1 so it will invoke the method to determine and update the Softaculous records with the correct version of the installation   |
