## Enable/Disable script using Softaculous API Guide
This guide explains how to enable/disable script using Softaculous API.

### via cURL
```php

curl -d "updatesoft=Update Settings" -d "soft_26=1" -d "soft_18=1" -d "soft_543=1" -d "soft_11=1" -d "soft_3=1" -d "soft_34=1" -d "soft_14=1" -d "soft_470=1" "https://user:password@domain.com:2087/url/to/softaculous/index.php?act=softwares&api=json"

```

### via PHP script

```php

<?php

// URL
$url = 'http://admin.controlpanel.com:PORT/url/to/softaculous/index.php?'.
			'&api=serialize'.
			'&act=softwares';

$post = array('updatesoft' => 'Update Settings',
	'soft_26' => 1, // WordPress
	'soft_18' => 1, // Joomla 2.5
	'soft_543' => 1, // Drupal 8
	'soft_11' => 1, // Open Blog
	'soft_3' => 1, // Serendipity
	'soft_34' => 1, // Dotclear
	'soft_14' => 1, // b2evolution
	'soft_470' => 1 // Ghost
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
    [title] => Softaculous - Admin Panel
    [done] => 1
    [allcatwise] => Array
        (
            [php] => Array
                (
                    [blogs] => Array
                        (
                            [26] => Array
                                (
                                    [sid] => 26
                                    [parent] => 0
                                    [name] => WordPress
                                    [softname] => wp
                                    [fullname] => WordPress
                                    [type] => php
                                    [views] => 1195573
                                    [ratings] => 4.705
                                    [votes] => 27355
                                    [reviews] => 686
                                    [space] => 77681630
                                    [support] => http://www.wordpress.org/
                                    [version] => 6.9.4
                                    [category] => blogs
                                    [logo] => logo.gif
                                    [screenshot] => screenshot.jpg
                                    [description] => WordPress is web software you can use to create a beautiful website or blog.
                                    [desc] => WordPress is a state-of-the-art publishing platform with a focus on aesthetics, web standards, and usability.
                                    [approved] => 1
                                    [ins] => 0
                                    [mod] => 258
                                    [mod_files] => 0
                                    [pd] => 1
                                    [auto_upgrade] => 1
                                    [release_date] => 11-03-2026
                                    [admin_url] => wp-admin/
                                    [php_min] => 7.2.24
                                    [php_max] => 
                                    [db] => mysql
                                    [cron] => 0
                                    [lang] => 
                                    [adname] => admin
                                    [adpass] => pass
                                    [eudemo_notes] => 
                                    [demo] => demos2.softaculous.com
                                    [urlname] => WordPress
                                    [screenshots] => Array()
                                    [ver] => 6.9.4
                                    [cat] => blogs
                                    [force_scripts] => 1
                                    [branches] => Array()
                                    [cur_ver] => 6.9.4
                                )
	
							)
				)
		)

    [timenow] => 1776073370
    [time_taken] => 15.97
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | softwares   |		This will trigger the enable/disable script function |
| **POST** |
| updatesoft | Update Settings  |	This will trigger the submit function for enabling/disabling the scripts |
| soft_26  | 1   |	Use it to Enable Script from Admin Panel. soft_ is the prefix for enabling a script and 26 is the id of the script to be enabled. Similarly pass a separate key for each script you want to enable. Get Script ids |
