## Manage WordPress plugins using Softaculous API Guide
This guide explains how to manage WordPress plugins using Softaculous API.

### via cURL
```php

curl -d "insid=26_12345" -d "type=plugins" -d "list=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=wordpress&api=json"

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
              'list' => '1'
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

   	[plugins_list] => Array
        (
            [akismet/akismet.php] => Array
                (
                    [Plugin Name] => Akismet Anti-spam: Spam Protection
                    [Plugin URI] => https://akismet.com/
                    [Description] => Used by millions, Akismet is quite possibly the best way in the world to protect your blog from spam. Akismet Anti-spam keeps your site protected even while you sleep. To get started: activate the Akismet plugin and then go to your Akismet Settings page to set up your API key.
                    [Version] => 5.6
                    [Author] => Automattic - Anti-spam Team
                    [Name] => Akismet Anti-spam: Spam Protection
                    [slug] => akismet
                    [activated] => 0
                )

            [hello.php] => Array
                (
                    [Plugin Name] => Hello Dolly
                    [Plugin URI] => http://wordpress.org/plugins/hello-dolly/
                    [Description] => This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from Hello, Dolly in the upper right of your admin screen on every page.
                    [Version] => 1.7.2
                    [Author] => Matt Mullenweg
                    [Name] => Hello Dolly
                    [slug] => .
                    [activated] => 0
                )

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
| list  | 1 | This shall list the installed plugins |
