## Add theme into set using Softaculous API Guide
This guide explains how to add a theme into set using Softaculous API.

### via cURL
```php
curl -d "add_plugins_themes_data_slugs[]=popularfx" -d "add_plugins_themes_data_names[]=PopularFx" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=manage_sets&sets_name=SET-NAME&themes=1&add_plugins_themes_data=1&api=json"
```

### via PHP script

```php

<?php

//The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
                        '&sets_name=SET-NAME'.
                        '&themes=1'.
                        '&add_plugins_themes_data=1'.
			'&act=manage_sets';

$post = array('add_plugins_themes_data_slugs' => array('popularfx'), //Slug name
              'add_plugins_themes_data_names' => array('PopularFx') //Theme name
);

// Set the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $time);
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
    [done_msg] => Your backup is being created in background. You will be notified by email once its completed. You can track the backup process from the  Task List page.
Your installation URL : https://domain.com
    [done] => TDpa5nojrXBWxcIcOBvNYF2e7X9
    [userins] => Array
        (
            [sid] => 26
            [ver] => 6.9
            [itime] => 1765257816
            [softpath] => /home/user/public_html
            [softurl] => https://domain.com
            [adminurl] => wp-admin/
            [disable_wp_cron] => 
            [admin_username] => admin
            [admin_email] => admin@domain.com
            [softdomain] => domain.com
            [softdb] => user_wp152
            [softdbuser] => user_wp152
            [softdbhost] => localhost
            [softdbpass] => pp@683p8S.
            [dbprefix] => wpom_
            [dbcreated] => 1
            [fileindex] => Array .................

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication  | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act  | manage_sets  | The value should be “manage_sets” to perform the action of installing theme to a set. |
| sets_name  | SET-NAME | The value should be name of your set  |
| themes  | 1 | The value of themes must be 1 to install theme in set  |
| add_plugins_themes_data  | 1 | The add_plugins_themes_data is to add the theme to the set. |
| **POST**    |
| add_plugins_themes_data_slugs  | An array with the theme slugs | An array with the theme slugs that you want to add.  |
| add_plugins_themes_data_names | An array with the theme names | An array with the theme names that you want to add. |
