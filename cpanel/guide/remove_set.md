## Remove set using Softaculous API Guide
This guide explains how to remove a set using Softaculous API.

### via cURL
```php
curl -d "sets[]=SET-NAME" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=manage_sets&remove_sets=1&api=json"
```

### via PHP script

```php

<?php

//The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			        '&api=serialize'.
              '&remove_sets=1'.
			        '&act=manage_sets';

$post = array('sets' => array('SET-NAME'), //Set name

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
    [done] => Plugins(s) and themes(s) added
    [sets] => Array
        (
            [SET-NAME] => Array
                (
                    [enduser_set] => 1
                    [plugins] => Array
                        (
                            [loginizer] => Loginizer
                        )
                    [themes] => Array
                        (
                            [popularfx] => PopularFx
                        )

                )

        )

    [timenow] => 1766127685
    [time_taken] => 0.093
)
```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication  | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act  | manage_sets  | 	The value should be “manage_sets” to perform the action of removing a set. |
| remove_sets  | 1 | This will trigger the removal process of set. |
| **POST**    |
| sets | An array with the set names |An array with the set names you want to remove.  |
