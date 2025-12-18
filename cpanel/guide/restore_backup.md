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
    [done_msg] => Your backup is being restored in background. You will be notified by email once its completed. You can track the restore process from the  Task List page.
    [done] => lcQHre7jhFl6APp9HOxMQBZqEBAyTaFV
    [dbexist] => softsql.sql
    [datadir] => 
    [wwwdir] => 
    [soft] => 26
    [backupinfo] => Array
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
            [name] => wp.26_94698.2025-12-18_13-03-10
            [path] => /home/user/softaculous_backups
            [backup_db] => 1
            [backup_dir] => 1
            [backup_datadir] => 
            [backup_wwwdir] => 
            [backup_note] => 
            [ssk] => JNBUhWPrp73V3lRiUfAOjXqXcmI
            [soft_version] => 6.3.1
            [btime] => 1766043190
            [ext] => tar.gz
            [size] => 33671122
        )

    [ins] => Array
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
            [softdbpass] => *******
            [dbprefix] => wphh_
            [dbcreated] => 1
            [fileindex] => Array()
			[site_name] => My Blog
            [insid] => 26_12345
            [script_name] => WordPress
            [name] => wp.26_94698.2025-12-18_13-03-10
            [path] => /home/user/softaculous_backups
            [backup_db] => 1
            [backup_dir] => 1
            [backup_datadir] => 
            [backup_wwwdir] => 
            [backup_note] => 
            [ssk] => JNBUhWPrp73iUfAOwwjXqXcmI
            [soft_version] => 6.3.1
            [btime] => 1766043190
            [ext] => tar.gz
            [size] => 33671122
        )

    [timenow] => 1766044812
    [time_taken] => 0.849
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | restore | The value should be “restore” to perform the action of restoring the backup of the installation. |
| restore | backup_time_insid.tar.gz (Backup File Name)  | Name of the Backup File. |
| **POST**    |
| restore_ins  | 1   | This will trigger the restore function.  |
| restore_dir | 1   | 	This is to restore the directory  |
| restore_datadir  | 1   | This is to restorethe data directory  |
| restore_db  | 1   | This is to restore the database  |
| noemail  | 1   | (Optional) – Use this only if you do not want to send an email to the user |
