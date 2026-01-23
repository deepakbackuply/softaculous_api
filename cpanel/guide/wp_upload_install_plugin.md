## Upload and install plugin using Softaculous API Guide
This guide explains how to upload and install plugins using Softaculous API.

### via cURL
```php

curl -i -X POST -H "Content-Type: multipart/form-data" -F "custom_file=@/path/to/loginizer.1.6.7.zip" -F "insid=26_12345" -F "type=plugins" -F "activate=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=wordpress&api=json&upload=1"

```

### via PHP script

```php

//The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
				'&api=serialize'.
				'&act=wordpress'.
                '&upload=1';

// Plugin zip file
$file_name_with_full_path = 'loginizer.1.6.7.zip';

// php 5.5+
if (function_exists('curl_file_create')) { 
  $cFile = curl_file_create($file_name_with_full_path);
} else { 
  $cFile = '@' . realpath($file_name_with_full_path);
}

$post = array('insid' => '26_12345',
              'type' => 'plugins',
              'activate' => '1',
              'custom_file' => $cFile
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
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
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
| act  | wordpress  | The value should be “wordpress” to load WordPress Manager. |
| upload | 1 | 	The value should be 1 to perform the action of upload & install plugin. |
| **POST** |
| insid  | 26_12345  | The installation ID for which you want to install the plugin. |
| type  | plugins  | The value should be “plugins” |
| custom_file | /path/to/loginizer.1.6.7.zip | The value is the full path on your server for plugin zip file to be installed |
| activate | 1 | This is to activate the plugin upon installation <br> 0 – If you do not want to activate the plugin <br> 1- If you want to activate the plugin |
