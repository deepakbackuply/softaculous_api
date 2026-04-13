## Delete ACL plan using Softaculous API Guide
This guide explains how to delete ACL plan using Softaculous API.

### via cURL
```php

curl "https://user:password@domain.com:2087/url/to/softaculous/index.php?act=plans&delete=plan1&api=json"

```

### via PHP script

```php

<?php 

// URL
$url = 'http://admin.controlpanel.com:PORT/url/to/softaculous/index.php?'.
			'&api=serialize'.
			'&act=plans'.
			'&delete=plan1';

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
    [plans] => Array
        (
            [/usr/local/softaculous/conf/userplan.plan] => Array
                (
                    [level] => 1
                    [dir] => 0
                    [name] => userplan.plan
                    [path] => /usr/local/softaculous/conf/
                )

        )

    [timenow] => 1776072100
    [time_taken] => 0.001
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | plans   |	This is the default plans page act |
| delete   | plan1   | This will be the plan name of the plan you want to delete |
