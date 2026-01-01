## Enable/Disable WordPress CRON using Softaculous API Guide
This guide explains how to enable/disable WordPress CRON using Softaculous API.

### via cURL
```php

curl -d "insid=26_31793" -d "disable_wp_cron=0" -d "save=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=wordpress&api=json"

```

### via PHP script

```php

<?php

//The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			          '&api=serialize'.
                '&act=wordpress';

$post = array('insid' => '26_31793',
              'disable_wp_cron' => '0',
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
| act  | wordpress | The value should be “wordpress” to perform the action of enabling/disabling the WordPress cron. |
| **POST**    |
| insid  | 26_12345 | The installation ID for which you want to enable/disable the WordPress cron.  |
| disable_wp_cron | 0 | The values to enable/disable the WordPress cron: <br> 0 – Enable <br> 1 – Disable |
| save | 1 | 	This shall enable/disable the WordPress cron. |
