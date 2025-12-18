## Installations backup using Softaculous API Guide

This document explains how to create a backup of the installations using Softaculous API.


### via cURL
```php
curl -d "backupins=1" -d "backup_dir=1" -d "backup_datadir=1" -d "backup_db=1" -d "backup_location=2" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=backup&insid=26_4545&api=json"
```

### via PHP script

```php

<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=backup'.
			'&insid=26_4545';

$post = array('backupins' => '1',
              'backup_dir' => '1', // Pass this if you want to backup the directory
              'backup_datadir' => '1', // Pass this if you want to backup the data directory
              'backup_db' => '1', // Pass this if you want to backup the database
              'backup_location' => '2' //Pass this if you want the current backup to be stored at a different location.
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

print_r($resp);

?>
```
### Expected response
```php
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done_msg] => Your backup is being created in background. You will be notified by email once its completed. You can track the backup process from the  Task List page.
Your installation URL : https://domain.com
    [done] => JNBUhWPrp73V3lRRiUfOwwjXqXcmI
    [userins] => Array
        (
            [sid] => 26
            [ver] => 6.9
            [itime] => 1766039749
            [softpath] => /home/user/public_html
            [softurl] => https://domain.com
            [adminurl] => wp-admin/
            [disable_wp_cron] => 
            [admin_username] => admin
            [admin_email] => admin@domain.com
            [softdomain] => domain.com
            [softdb] => wp118
            [softdbuser] => wp118
            [softdbhost] => localhost
            [softdbpass] => ********
            [dbprefix] => wphh_
            [dbcreated] => 1
            [fileindex] => Array()
            [site_name] => My Blog
            [insid] => 26_12345
            [script_name] => WordPress
        )

    [backupfile] => 
    [insid] => 26_12345
    [software] => Array
        (
            [name] => WordPress
            [softname] => wp
            [desc] => WordPress is a state-of-the-art publishing platform with a focus on aesthetics, web standards, and usability.
            [ins] => 1
            [cat] => blogs
            [type] => php
            [ver] => 6.9
            [pre_down] => 1
            [path] => /var/softaculous/wp
        )

    [soft] => 26
    [error] => 
    [timenow] => 1766043190
    [time_taken] => 0.088
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | backup   | The value should be “backup” to perform the action of taking the backup of the installation. |
| insid    | 26_4545 (Installation ID)   |Installation ID of the installed script.  |
| **POST**    |
| backupins  | 1   | This will trigger the backup function.   |
| backup_dir | 1   | 	This is to backup the directory  |
| backup_datadir  | 1   | This is to backup the data directory   |
| backup_db  | 1   | 	This is to backup the database   |
| backup_location  | 2 (Location ID)   | (Optional) – Location id of the backup location where you want to store your current backup. Default value will be the one saved in the installation’s settings. You can find the location id from List Backup Locations   |
| noemail  | 1   | (Optional) – Use this only if you do not want to send an email to the user   |
