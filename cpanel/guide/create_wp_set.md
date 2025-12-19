## Create a set using Softaculous API Guide

This guide explains how create a set using Softaculous API.


### via cURL
```php
curl -d "set_input=SET-NAME" -d "add_sets=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=manage_sets&api=json"
```

### via PHP script

```php

<?php

//The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
        			'&api=serialize'.
        			'&act=manage_sets';

$post = array('set_input' => 'SET-NAME', //Name of your set
              'add_sets' => '1'
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
    [title] => Softaculous - Powered by Softaculous
    [done] => Set added
    [sets] => Array
        (
            [SET-NAME] => Array
                (
                )
        )

    [timenow] => 1766125266
    [time_taken] => 0.090
)
```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication  | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | manage_sets  | The value should be “backup” to perform the action of taking the backup of the installation. |
| **POST**    |
| set_input  | SET-NAME | The value must be name of your set |
| add_sets | 1   | This will trigger the addition of set  |
