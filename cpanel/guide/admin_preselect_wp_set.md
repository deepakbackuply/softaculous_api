## Remove set from admin Softaculous API Guide
This guide explains how to remove set from Softaculous admin using Softaculous API.

### via cURL
```php

curl -d "sets[]=SET-NAME_admin" "https://user:password@domain.com:2087/url/to/softaculous/index.php?act=manage_sets&remove_sets=1&api=json"
```
### via PHP script

```php

<?php

//The URL
$url = 'http://admin.controlpanel.com:PORT/url/to/softaculous/index.php'.
			    '&api=serialize'.
          '&remove_sets=1'.
			    '&act=manage_sets';

$post = array('sets' => array('SET-NAME_admin'), //Set name

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
    [done] => Plugins(s) and themes(s) added
    [sets] => Array
        (
            [sets_admin] => Array
                (

                    [themes] => Array
                        (
                            [popularfx] => Popularfx
                        )

                )

        )

    [timenow] => 1776078589
    [time_taken] => 0.001
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | manage_sets   |	The value should be “manage_sets” to perform the action of removing a set. |
| remove_sets  | 1  |	This will trigger the removal process of set. |
| **POST** |
| sets | An array with the set names  |	An array with the set names you want to remove and append the _admin to the set name for admin sets. |
