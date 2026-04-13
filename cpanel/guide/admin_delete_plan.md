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
    [unserplan] => Array
        (
            [name] => plan1
            [disable_autoupgrade] => 0
            [max_ins_script] => 
            [max_backup_script] => 
            [max_clone_script] => 
            [max_staging_script] => 
            [sets] => Array
                (
                )

            [scripts] => Array
                (
                    [26] => 26
                    [11] => 11
                )

        )

    [acl] => Array
        (
            [users] => Array
                (
                    [abc] => plan1
                )
        )

    [_users] => Array
        (
            [user1] => Array
                (
                    [original_key] => user1
                )
        )

    [_cpplan] => Array
        (
            [Package] => Array
                (
                    [original_key] => Package
                )
        )

    [allcatwise] => Array
        (
            [php] => Array
                (
                    [blogs] => Array
                        (
                            [26] => Array
                                (
                                    [name] => WordPress
                                    [softname] => wp
                                    [desc] => WordPress is a state-of-the-art publishing platform with a focus on aesthetics, web standards, and usability.
                                    [ins] => 1
                                    [cat] => blogs
                                    [type] => php
                                    [ver] => 6.9.4
                                )
							[11] => Array
								(
									[name] => Pubvana
									[softname] => openb
									[desc] => Kick-ass Blog application built using the CodeIgniter PHP Framework
									[ins] => 1
									[cat] => blogs
									[type] => php
									[ver] => 1.0.4
								)
						)
                )
        )

    [_resellers] => Array
        (
            [alex] => Array
                (
                    [original_key] => alex
                )
        )

    [timenow] => 1776067137
    [time_taken] => 0.002
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | plans   |	This is the default plans page act |
| delete   | plan1   | This will be the plan name of the plan you want to delete |
