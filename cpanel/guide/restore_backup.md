## Restore backup using Softaculous API Guide
This guide will help you to restore the backup created via Softaculous. (i.e. If you want to restore your WordPress Installation) 

### via cURL
```php
curl -d "restore_ins=1" -d "restore_dir=1" -d "restore_datadir=1" -d "restore_db=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=restore&restore=backup_time_insid.tar.gz&api=json"
```

### via PHP script

```php

<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=restore'.
			'&restore=backup_time_insid.tar.gz';

$post = array('restore_ins' => '1',
              'restore_dir' => '1', // Pass this if you want to restore the directory
              'restore_datadir' => '1', // Pass this if you want to restore the data directory
              'restore_db' => '1', // Pass this if you want to restore the database
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
$res = unserialize($resp);

print_r($res);

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
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | backup   | The value should be “backup” to perform the action of taking the backup of the installation. |
| insid    | 26_4545 (Installation ID)   | Installation ID of the installed script. It can be fetched from List Installed Script   |
| **POST**    |
| backupins  | 1   | This will trigger the backup function.   |
| backup_dir | 1   | 	This is to backup the directory  |
| backup_datadir  | 1   | This is to backup the data directory   |
| backup_db  | 1   | 	This is to backup the database   |
| backup_location  | 2 (Location ID)   | (Optional) – Location id of the backup location where you want to store your current backup. Default value will be the one saved in the installation’s settings. You can find the location id from List Backup Locations   |
| noemail  | 1   | (Optional) – Use this only if you do not want to send an email to the user   |
