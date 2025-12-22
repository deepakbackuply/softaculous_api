## Auto Upgrade Plugins/Themes Settings using Softaculous API Guide
This guide explains how to auto upgrade plugins themes settings using Softaculous API.

### via cURL
```php

curl -d "insid=26_31793" -d "auto_upgrade_plugins=1" -d "auto_upgrade_themes=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=wordpress&api=json"

```

### via PHP script

```php

//The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			            '&api=serialize'.
                  '&act=wordpress';

$post = array('insid' => '26_12345',
              'auto_upgrade_plugins' => '1',
              'auto_upgrade_themes' => '1',
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
            [itime] => 1766062062
            [softpath] => /home/user/public_html
            [softurl] => http://domain.com
            [admin_folder] => wp-admin/
            [site_name] => myblog
            [softdomain] => domain.com
            [softdb] => wp143
            [softdbuser] => wp143
            [softdbhost] => localhost
            [softdbpass] => ******
            [dbcreated] => 1
            [dbprefix] => wphh_
            [insid] => 26_12345
            [script_name] => WordPress
            [eu_auto_upgrade] => 1
        )

    [userins] => Array
        (
            [sid] => 26
            [ver] => 6.9
            [itime] => 1766062062
            [softpath] => /home/user/public_html/wp
            [softurl] => http://domain.com/wp
            [admin_folder] => wp-admin/
            [site_name] => myblog
            [softdomain] => domain.com
            [softdb] => wp143
            [softdbuser] => wp143
            [softdbhost] => localhost
            [softdbpass] => ******
            [dbcreated] => 1
            [dbprefix] => wphh_
            [fileindex] => Array()
            [insid] => 26_45678
            [script_name] => WordPress
            [eu_auto_upgrade] => 1
        )

    [featured_plugins_list] => Array
        (
            
        )

    [wordpressins] => Array
        (
            
        )

    [scripts_admin_url] => wp-admin/
    [notes] => 
    [users_list] => 
    [user_roles] => 
    [timenow] => 1766405057
    [time_taken] => 0.111
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication  | -   | You can use the Enduser Authenticating methods. |
| act  | wordpress  | The value should be “wordpress” to perform the action of enabling auto upgrade plugin/theme settings. |
| **POST**    |
| insid  | 26_12345 | The installation ID for which you want to enable auto upgrade . |
| auto_upgrade_plugins | 1 | 	The values for auto upgrade plugin setting can be: <br> 0 – Do not upgrade <br> 1 – Enable auto upgrade of plugin |
| auto_upgrade_themes | 1 | 	The values for auto upgrade theme setting can be: <br> 0 – Do not upgrade <br> 1 – Enable auto upgrade of theme |
| save | 1 | 	This shall enable the auto upgrade for plugin/theme |

