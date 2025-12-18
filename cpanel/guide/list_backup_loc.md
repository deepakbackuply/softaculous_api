## List backup locations using Softaculous API Guide
This guide explains how to list the backup location using Softaculous API.

### via cURL
```php
curl "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=settings&api=json"
```

### via PHP script

```php

<?php

//The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
          	    '&api=serialize'.
          	    '&act=settings';
			
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

//Display the list of backup locations
print_r($res['backup_locs']);

print_r($res);

?>
```
### Expected response
```php
Array
(
    [1] => Array
        (
            [id] => 1
            [name] => Backuploc1
            [protocol] => ftp
            [server_host] => ftp.domain.com
            [port] => 21
            [ftp_user] => user
            [ftp_pass] => pass
            [private_key] => 
            [passphrase] => 
            [backup_loc] => /backups
            [full_backup_loc] => ftp://user:pass@ftp.domain.com:21/backups
        )

)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating methods. |
| act    | settings | The value should be “settings” to perform the action to list the backup locations added by you. |
