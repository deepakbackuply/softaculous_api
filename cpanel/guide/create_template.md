## Create template using Softaculous API Guide
This guide explains how to create a template using the Softaculous API.

### via cURL
```php
curl -d "template_name=MyTemplate" -d "template_type=1" -d "disallow_plugins=on" -d "createtemplate=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=create_template&insid=26_12345&autoid=abcdefghijklmnopqrstuvwxyz0123456789&api=json"
```

### via PHP script

```php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
        			'&api=serialize'.
        			'&act=create_template'.
        			'&insid=26_12345'.
        			'&autoid=abcdefghijklmnopqrstuvwxyz0123456789';

$post = array('template_name' => 'My Template',
              'template_type' => 1,
              'createtemplate' => 1,
              'disallow_plugins' => 'on',
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
if(!empty($res['done'])){

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
Your template is being created in background. You will be notified by email once its completed. You can track the process from the  Task List page.
Your installation URL : https://domain.com
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done_msg] => Your template is being created in background. You will be notified by email once its completed. You can track the process from the  Task List page.
Your installation URL : https://domain.com
    [done] => DOA1GnzLNibeqHaXw0KW7Zoj2
    [userins] => Array
        (
            [sid] => 26
            [ver] => 6.9
            [itime] => 1766039749
            [softpath] => /home/user/public_html
            [softurl] => https://domain.com
            [adminurl] => wp-admin/
            [disable_wp_cron] => 
            [admin_username] => admin
            [admin_email] => admin@domain.com
            [softdomain] => domain.com
            [softdb] => wp123
            [softdbuser] => wp123
            [softdbhost] => localhost
            [softdbpass] => ******
            [dbprefix] => wphh_
            [dbcreated] => 1
            [fileindex] => Array()....
        )

    [templatefile] => 
    [insid] => 26_94698
    [software] => Array()...
    [soft] => 26
    [error] => 
    [timenow] => 1766058134
    [time_taken] => 0.080
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | create_template  | The value should be “create_template” to perform the action of template creation. |
| insid    | 26_14545 | The installation ID of the installation/website of which you want to create a template. |
| **POST**    |
| template_name  | My Template | This will trigger the backup function.   |
| template_type |1 or 2 | 1 = private & 2 = public, Public templates can be used to launch websites by anyone & private by the creator only. |
| disallow_plugins  | on | Send “on” to not allow installations of plugins and skip this parameter to allow. |
| createtemplate  | 1   | To trigger the create template process.  |
