# Remove an installed installation 

This document explains how to remove an installation using Softaculous API.


## via cURL
```php
curl -d "removeins=1" -d "remove_dir=1" -d "remove_datadir=1" -d "remove_db=1" -d "remove_dbuser=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=remove&insid=26_12345&api=json"
```

## via PHP script

```php
<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=remove'.
			'&insid=26_12345';

$post = array('removeins' => '1',
              'remove_dir' => '1', // Pass this if you want the directory to be removed
              'remove_datadir' => '1', // Pass this if you want the data directory to be removed
              'remove_db' => '1', // Pass this if you want the database to be removed
              'remove_dbuser' => '1' // Pass this if you want the database user to be removed
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

$res = unserialize($resp);
print_r($res);

?>

```
### Expected output of $resp
```php
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done] => 1
    [insid] => 26_12345
    [user_ins] => Array
        (
            [sid] => 26
            [ver] => 6.9
            [itime] => 1765349331
            [softpath] => /home/user/public_html
            [softurl] => https://domain.com
            [adminurl] => wp-admin/
            [disable_wp_cron] => 
            [admin_username] => admin
            [admin_email] => admin@domain.com
            [softdomain] => domain.com
            [softdb] => wp139
            [softdbuser] => wp139
            [softdbhost] => localhost
            [softdbpass] => *******
            [dbprefix] => wpey_
            [dbcreated] => 1
            [fileindex] => Array
                (
                    [0] => index.php
                    [1] => license.txt
                    [2] => readme.html
                    [3] => wp-activate.php
                    [4] => wp-admin
                    [5] => wp-blog-header.php
                    [6] => wp-comments-post.php
                    [7] => wp-config-sample.php
                    [8] => wp-content
                    [9] => wp-cron.php
                    [10] => wp-includes
                    [11] => wp-links-opml.php
                    [12] => wp-load.php
                    [13] => wp-login.php
                    [14] => wp-mail.php
                    [15] => wp-settings.php
                    [16] => wp-signup.php
                    [17] => wp-trackback.php
                    [18] => xmlrpc.php
                    [19] => wp-config.php
                    [20] => .htaccess
                )

            [site_name] => My Blog
            [insid] => 26_12345
            [display_softdbpass] => ******
            [script_name] => WordPress
        )

    [software] => Array ...........

```

## Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | remove   | The value should be “remove” to perform the action of removing an installed script.   |
| insid    | 26_12345 (Installation ID)   | Installation ID of the installed script. It can be fetched from List Installed Script  |
| **Post** |
| removeins    | 1   | This will trigger the remove install process  |
| remove_dir    | 1   | This is to remove the directory where the script is installed. If you do not want to remove the directory do not pass this key in post. |
| remove_datadir    | 1   | 	This is to remove the data directory where the script is installed. If you do not want to remove the data directory do not pass this key in post.  |
| remove_db    | 1   | This is to remove the database of the installation. If you do not want to remove the database do not pass this key in post.  |
| remove_dbuser    | 1   | This is to remove the database user of the installation. If you do not want to remove the database user do not pass this key in post.  |
| noemail    | 1   | (Optional) – Use this only if you do not want to send an email to the user   |
