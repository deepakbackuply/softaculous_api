## Restore template using Softaculous API Guide
This guide explains how to restore a template using Softaculous API.

### via cURL
```php
curl -d "softproto=1" -d "softdomain=domain.com" -d "softdirectory=wptemplate" -d "softdb=wp123" -d "site_name=myblog" -d "softsubmit=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=restore_template&restore=my-template.tar.gz&autoid=abcdefghijklmnopqrstuvwxyz0123456789&api=json"
```

### via PHP script

```php

<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=restore_template'.
			'&restore=my-template.tar.gz'.
			'&autoid=abcdefghijklmnopqrstuvwxyz0123456789';

$post = array('softproto' => 1,
              'softsubmit' => 1,
              'softdomain' => 'domain.com',
              'softdb' => 'wp123',
              'site_name' => 'myblog',
              'softdirectory' => 'restoredsite',
	      );

// Set the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

if(!empty($post)){
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
}

// Turn off the server and peer verification (TrustManager Concept).
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
 
// Get response from the server.
$resp = curl_exec($ch);

// The response will hold a string as per the API response method. In this case its PHP Serialize
$res = unserialize($resp);
 
// Done ?
if(!empty($res['done_msg'])){

	echo $res['done_msg'];

// Error
}else{

	echo 'Some error occured';
	print_r($res['error']);

}

// Print the entire output just incase !
print_r($res);

?>
```
### Expected response
```php
Template Restore process has been pushed in background
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done_msg] => Template Restore process has been pushed in background
    [insid] => 
    [done] => lMeIn0mZurZY3WIRB3E7TIvV
    [userins] => Array
        (
            [sid] => 26
            [ver] => 6.9
            [itime] => 1766039749
            [softpath] => /home/user/public_html
            [softurl] => https://script.nuftp.com
            [adminurl] => wp-admin/
            [disable_wp_cron] => 
            [admin_username] => admin
            [admin_email] => admin@domain.com
            [softdomain] => domain.com
            [softdb] => wp123
            [softdbuser] => wp123
            [softdbhost] => localhost
            [softdbpass] => *****
            [dbprefix] => wphh_
            [dbcreated] => 1
            [fileindex] => Array()
        )

    [dbtype] => mysql
    [__settings] => Array
        (
            [php_path] => php
            [fname] => my-template.tar.gz
            [no_search_engine] => 
            [site_name] => myblog
            [ver] => 6.9
            [softdomain] => domain.com
            [softdirectory] => wp
            [softpath] => /home/user/public_html/restore_temp
            [softurl] => http://domain.com/restore_temp
            [softdb] => wp123
            [softdbuser] => wp123
            [softdbhost] => localhost
            [fileindex] => Array()
        )
    [protocols] => Array
        (
            [1] => http://
            [2] => http://www.
            [3] => https://
            [4] => https://www.
        )
    [nopackage] => 
    [setupcontinue] => 
    [timenow] => 1766062061
    [time_taken] => 76.25
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication  | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | restore_template | The value should be “restore_template” to perform the action of template restoration. |
| restore | my-template.tar.gz | The template file name with extension. |
| **POST**    |
| softproto | 	1 – http:// <br> 2 – http://www. <br> 3 – https:// <br> 4 – https://www. | (Optional) – Protocol to be used for the restoration. |
| softdomain | domain.com | This is the domain on which you wish to restore the template on. |
| softdirectory  | wptemplate | This is the sub-directory to restore the template in. Leave it blank to restore in the root of the domain. |
| softdb | wp123 | This is the database name for the installation. |
| site_name | My Blog | The value is the blog or site name. |
| softsubmit  | 1   | This will trigger the restore. |
