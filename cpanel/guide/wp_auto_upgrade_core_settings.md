## Auto Upgrade Core Settings using Softaculous API Guide
This guide explains how to auto-upgrade core settings using Softaculous API.

### via cURL
```php
curl -d "insid=26_31793" -d "auto_upgrade_core=1" -d "save=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=wordpress&api=json"
```

### via PHP script

```php

<?php

//The URL
//The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			          '&api=serialize'.
                '&act=wordpress';

$post = array('insid' => '26_31793',
              'auto_upgrade_core' => '1',
              'save' => '1'
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
| Authentication  | -   | You can use the Enduser Authenticating methods. |
| act  | wordpress  | The value should be “wordpress” to perform the action of enabling auto upgrade core settings. |
| **POST**    |
| insid  | 26_12345 | The installation ID for which you want to enable auto upgrade. |
| auto_upgrade_core | 1 | The values for auto upgrade core settings can be: <br> 0 – Do not upgrade <br> 1 – Upgrade to minor version only <br> 2- Upgrade to any latest version available (Major as well as Minor) |
| save | 1 | This shall enable the auto upgrade core settings |
