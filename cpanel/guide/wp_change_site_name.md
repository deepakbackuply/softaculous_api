## Change site name using Softaculous API Guide
This guide explains how to change site name using Softaculous API.

### via cURL
```php

curl -d "insid=26_12345" -d "softurl=https://example.com/test" -d "site_name=My Blog Test" -d "save_info=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=wordpress&api=json"

```

### via PHP script

```php

<?php

//The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			  '&api=serialize'.
			  '&act=wordpress';

$post = array('insid' => '26_12345',
              'softurl' => 'https://example.com/test',
              'site_name' => 'My Blog Test',
              'save_info' => '1'
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
| act  | wordpress  | The value should be “wordpress” to perform the action of changing the Site name in WordPress. |
| **POST** |
| insid  | 26_12345  | 	The installation ID for which you want to change the Site name. |
| softurl  | https://example.com/test  | The value is the name of the URL. |
| site_name  | My Blog Test | The value is the blog or site name. |
| save_info  | 1 | This shall save the changed site URL. |
