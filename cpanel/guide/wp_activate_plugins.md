## Activate WordPress plugins using Softaculous API Guide
This guide explains how to activate WordPress plugins using Softaculous API.

### via cURL
```php

curl -d "insid=26_12345" -d "type=plugins" -d "slug=akismet/akismet.php" -d "activate=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=wordpress&api=json"

```

### via PHP script

```php

<?php

//The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			      '&api=serialize'.
            '&act=wordpress';

$post = array('insid' => '26_12345',
              'type' => 'plugins',
              'slug' => 'akismet/akismet.php',
              'activate' => '1'
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
            [itime] => 1768896820
            [softpath] => /home/user/public_html
            [softurl] => https://domain.com
            [adminurl] => wp-admin/
            [admin_username] => admin
            [admin_email] => admin@domain.com
            [softdomain] => domain.com
            [softdb] => wp922
            [softdbuser] => wp922
            [softdbhost] => localhost
            [softdbpass] => *******
            [dbprefix] => wp7f_
            [dbcreated] => 1
            [fileindex] => Array()
            [site_name] => My Blog Test
            [insid] => 26_12345
            [script_name] => WordPress
            [autopass] => fyc9sivdqui9f5wwevnz1lp
            [plugins_to_activate] => a:1:{s:19:"akismet/akismet.php";s:19:"akismet/akismet.php";}
        )
    [scripts_admin_url] => wp-admin/
    [notes] => 
    [users_list] => 
    [user_roles] => 
    [timenow] => 1768897207
    [time_taken] => 0.113
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication  | -   | You can use the Enduser Authenticating methods. |
| act  | wordpress  | The value should be “wordpress” to load WordPress Manager. |
| **POST** |
| insid  | 26_12345  | The installation ID for which you want to activate the plugin. |
| type  | plugins  | The value should be “plugins” |
| slug  | akismet/akismet.php | The value is the plugin file path. Generally plugin folders are designed like <pluginname>/<pluginname>.php |
| activate | 1 | This shall activate the plugin |
