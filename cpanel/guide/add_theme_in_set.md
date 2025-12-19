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
    [done] => Plugins(s) and themes(s) added
    [sets] => Array
        (
            [SET-NAME] => Array
                (
                    [enduser_set] => 1
                    [plugins] => Array
                        (
                            [loginizer] => Loginizer
                        )
                    [themes] => Array
                        (
                            [popularfx] => PopularFx
                        )

                )

        )

    [timenow] => 1766127685
    [time_taken] => 0.093
)
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
