## Pre-select admin set Softaculous API Guide
This guide explains how to pre-select admin set using Softaculous API.

### via cURL
```php

curl "https://user:password@domain.com:2087/url/to/softaculous/index.php?act=manage_sets&set_name=SET-NAME_admin&default_value=1&api=json"

```
### via PHP script

```php

<?php

//The URL
$url = 'http://admin.controlpanel.com:PORT/url/to/softaculous/index.php'.
    			'&api=serialize'.
				'&set_name=SET-NAME_admin'.
				'&default_value=1'.
    			'&act=manage_sets';

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

	print_r($res);

// Error
}else{

	echo 'Some error occured';
	print_r($res['error']);

}

?>
```
### Expected response
```php

Array
(
    [title] => Softaculous - Admin Panel
    [done] => Preference saved successfully
    [sets] => Array
        (
            [sets_admin] => Array
                (
                    [plugins] => Array
                        (
                            [loco-translate] => Loco Translate
                        )

                    [themes] => Array()
                    [default_value] => 1
                )

        )

    [timenow] => 1776083757
    [time_taken] => 0.000
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act  | manage_sets   |	The value should be “manage_sets” to perform the action of removing a set. |
| set_name  | SET-NAME_admin |	The value should be name of your set which to be pre-selected on install form and also append _admin to the set name for admin sets. |
| default_value | 1 | This will pre-select the set. |
