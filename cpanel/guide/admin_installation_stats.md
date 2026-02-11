## Installation statistics using Softaculous API Guide
This guide explains how to fetch installation statistics using Softaculous API.

### via cURL
```php

curl "https://user:password@domain.com:2087/url/to/softaculous/index.php?act=ins_statistics&api=json"

```

### via PHP script

```php

// URL
$url = 'http://admin.controlpanel.com:PORT/url/to/softaculous/index.php?'.
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
    [543] => Array
        (
            [543_12345] => Array
                (
                    [sid] => 543
                    [ver] => 11.2.10
                    [itime] => 1766039576
                    [softpath] => /home/user/public_html/moodle
                    [softurl] => https://domain.com/moodle
                    [adminurl] => user/login
                    [softdomain] => domain.com
                    [softdb] => mood530
                    [softdbuser] => mood530
                    [softdbhost] => localhost
                    [softdbpass] => ********
                    [dbprefix] => drvt_
                    [dbcreated] => 1
                    [cron_time] => 43,5,*,*,*
                    [cron_command] => d2dldCAtTyAtICkZXYvbnVsbA==
                    [fileindex] => Array()
                    [admin_username] => admin
                    [admin_email] => admin@script.nuftp.com
                    [site_name] => My Drupal
                    [insid] => 543_12345
                    [display_softdbpass] => 7)V]1S8Mqp
                    [script_name] => Drupal Core
                )

        )

)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | ins_statistics   |	This will trigger the installation statistics function |
