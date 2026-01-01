## Enable/Disable WordPress Debug Mode using Softaculous API Guide
This guide explains how to enable/disable WordPress debug mode using Softaculous API.

### via cURL
```php

curl -d "insid=26_31793" -d "wp_debug=0" -d "save=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=wordpress&api=json"

```

### via PHP script

```php

<?php

//The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			          '&api=serialize'.
                '&act=wordpress';

$post = array('insid' => '26_31793',
              'wp_debug' => '1',
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
    [done] => 1
    [insid] => 26_12345
    [settings] => Array
        (
            [sid] => 26
            [ver] => 6.9
            [itime] => 1767271286
            [softpath] => /home/user/public_html
            [softurl] => https://domain.com
            [adminurl] => wp-admin/
            [disable_wp_cron] => 
            [admin_username] => admin
            [admin_email] => admin@domain.com
            [softdomain] => domain.com
            [softdb] => wp598
            [softdbuser] => wp598
            [softdbhost] => localhost
            [softdbpass] => ******
            [dbprefix] => wpl3_
            [dbcreated] => 1
            [fileindex] => Array()
            [site_name] => My Blog
            [insid] => 26_12345
            [script_name] => WordPress
        )

    [scripts_admin_url] => wp-admin/
    [notes] => 
    [users_list] => 
    [user_roles] => 
    [timenow] => 1767271350
    [time_taken] => 0.086
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication  | -   | You can use the Enduser Authenticating methods. |
| act  | wordpress | The value should be “wordpress” to perform the action of enabling/disabling the debug mode in WordPress. |
| **POST**    |
| insid  | 26_12345 | The installation ID for which you want to enable/disable the debug mode in WordPress. |
| wp_debug | 1 | The values to enable/disable the debug mode in WordPress: <br> 0 – Enable <br> 1 – Disable |
| save | 1 | 	This shall enable/disable the debug mode in WordPress. |
