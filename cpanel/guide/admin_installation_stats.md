## Installation statistics using Softaculous API Guide
This guide explains how to fetch installation statistics using Softaculous API.

### via cURL
```php

curl "https://user:password@domain.com:2087/cgi/softaculous/index.php?act=ins_statistics&api=json"

```

### via PHP script

```php

// URL
$url = 'http://user:password@admin.controlpanel.com:2087/cgi/softaculous/index.php?'.
			'&api=serialize'.
			'&act=ins_statistics';

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
    [ins_stats] => Array
        (
            [total_users] => 10
            [total_ins] => 12
        )

    [scriptwise_count] => Array
        (
            [26] => 12
        )

    [iscripts] => Array
        (
            [26] => Array
                (
                    [name] => WordPress
                    [softname] => wp
                    [desc] => WordPress is a state-of-the-art publishing platform with a focus on aesthetics, web standards, and usability.
                    [ins] => 1
                    [cat] => blogs
                    [type] => php
                    [ver] => 6.9.1
                    [pre_down] => 1
                )
		)
	[sn] => Softaculous
    [timenow] => 1770818899
    [time_taken] => 0.001
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | ins_statistics   |	This will trigger the installation statistics function |
