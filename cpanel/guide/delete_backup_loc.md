## Delete remote backup location using Softaculous API Guide
This guide explains how to delete a remote backup location using Softaculous API.

### via cURL
```php
curl "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=settings&del_loc_id=1&api=json"
```

### via PHP script

```php

<?php

$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
	     '&api=serialize'.
	     '&act=settings'.
	     '&del_loc_id=1';

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

// The response will hold a string as per the API response method. In this case its PHP Serialize.
$res = unserialize($resp);

//Display list of backup locations after successfully removal of a backup location.
print_r($res['backup_locs']);

?>
```
### Expected response
```php
Array
(
    [2] => Array
        (
            [id] => 2
            [name] => Google Backup2
            [protocol] => gdrive
            [gdrive_token] => ya29.a0Aa7pCA8Ya7Wgzsl2yF3DFsAaIjD6gAPeAq0dBCUetKnMY7CBgK2yqHJwyW8o2uQhYa2MiyCM2hNRgkSqCg0m5wxFxRw0206
            [gdrive_refresh_token] => 1//03XHKTG-UZ40lCgYIARAAGAzIwxB1AfS0w-gh818hUqMgVeT2VtwWi9V37ZB3mdiY5aQKhDFTM
            [backup_loc] => /google_backup2
            [full_backup_loc] => gdrive://1%2F%2F03XHKTG-UZ40lCgYIARAAGAMSNwF-L9IrSaX1FNQKhDFTM/Softaculous Auto Installer/google_backup2
        )

    [3] => Array
        (
            [id] => 3
            [name] => FTP Backup Location
            [protocol] => ftp
            [server_host] => ftp.domain.com
            [port] => 21
            [ftp_user] => user
            [ftp_pass] => pass
            [private_key] => 
            [passphrase] => 
            [backup_loc] => /ftp_backups
            [full_backup_loc] => ftp://user:pass@ftp.domain.com:21/ftp_backups
        )

)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating methods. |
| act    | settings | The value should be “settings” to perform the action to delete a particular remote backup location from list. |
| del_loc_id  | 1 | Location ID of a remote backup location.  |
