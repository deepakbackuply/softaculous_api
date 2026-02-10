## Security measures using Softaculous API Guide
This guide explains security measures using Softaculous API.

### via cURL
```php

curl -d "insids[]=26_12345" -d "secure_options[change_admin_username]=1" -d "secure_options[no_file_dir_access]=1" -d "secure_options[disable_xml_rpc]=1" -d "secure_options[block_htaccess]=1" -d "secure_options[disable_pingbacks]=1" -d "secure_options[no_file_editing]=1" -d "secure_options[block_author_scan]=1" -d "secure_options[block_dir_browsing]=1" -d "secure_options[no_php_exec_wpinc]=1" -d "secure_options[no_php_exec_wpuploads]=1" -d "secure_options[no_script_concat]=1" -d "secure_options[block_sensitive_files]=1" -d "secure_options[enable_bot_protection]=1" -d "save_security_measures=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=wordpress&api=json"

```

### via PHP script

```php

//The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
		              '&api=serialize'.
		              '&act=wordpress';

$post = array('insids' => array('26_31793'),
              		'secure_options'=> array(
        			'change_admin_username' => 1 ,
        			'no_file_dir_access' => 1 ,
        			'disable_xml_rpc' => 1 ,
        			'block_htaccess' => 1 ,
        			'disable_pingbacks' => 1 ,
        			'no_file_editing' => 1 ,
        			'block_author_scan' => 1 ,
        			'block_dir_browsing' => 1 ,
        			'no_php_exec_wpinc' => 1 ,
        			'no_php_exec_wpuploads' => 1 ,
        			'no_script_concat' => 1 ,
        			'block_sensitive_files' => 1 ,
        			'enable_bot_protection' => 1 ),
              		'save_security_measures' => '1'
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

```
### Expected response
```php
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done] => 1
	[featured_plugins_list] => Array()
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
| insid[]  | An array with installation IDs  | The installation IDs for which you want to apply WordPress Security Measures |
| secure_options['change_admin_username']  | 1 to enable and 0 to disable | Change default administrator’s username |
| secure_options['no_file_dir_access'] |1 to enable and 0 to disable | Restrict access to files and directories |
| secure_options['disable_xml_rpc'] |1 to enable and 0 to disable | Block unauthorized access to xmlrpc.php |
| secure_options['block_htaccess'] |1 to enable and 0 to disable | Block access to .htaccess and .htpasswd |
| secure_options['disable_pingbacks'] |1 to enable and 0 to disable | Turn off pingbacks |
| secure_options['no_file_editing'] |1 to enable and 0 to disable | Disable file editing in WordPress Dashboard |
| secure_options['block_author_scan'] |1 to enable and 0 to disable | Block author scans |
| secure_options['block_dir_browsing'] |1 to enable and 0 to disable | 	Block directory browsing |
| secure_options['no_php_exec_wpinc'] |1 to enable and 0 to disable | Forbid execution of PHP scripts in the wp-includes directory |
| secure_options['no_php_exec_wpuploads'] |1 to enable and 0 to disable | Forbid execution of PHP scripts in the wp-content/uploads directory |
| secure_options['no_script_concat'] |1 to enable and 0 to disable | Disable scripts concatenation for WordPress admin panel |
| secure_options['block_sensitive_files'] |1 to enable and 0 to disable | Block access to sensitive files |
| secure_options['enable_bot_protection'] |1 to enable and 0 to disable | Enable bot protection |
| save_security_measures | 1 | This shall trigger WordPress Security Measures |
