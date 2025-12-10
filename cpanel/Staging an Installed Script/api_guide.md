## Staging an Installed Script

This document explains how to create staging installation of the installed script using Softaculous API.


## via cURL
```php
curl -d "softsubmit=1" -d "softdomain=domain.com" -d "softdirectory=wp" -d "softdb=wpdb" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=staging&insid=26_12345&api=json"
```

## via PHP script

```php
<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=staging'.
      '&insid=26_12345';

$post = array('softsubmit' => '1',
              'softdomain' => 'domain.com', // Must be a valid Domain
              'softdirectory' => 'wp', // Keep empty to install in Web Root
              'softdb' => 'wpdb'
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
 
// The response will hold a string as per the API response method. In this case its PHP Serialize
$res = unserialize($resp);
 
// Done ?
if(!empty($res['done'])){

	echo 'Staging was successfully created. URL to Installation Staging installation : '.$res['__settings']['softurl'];

// Error
}else{

	echo 'Some error occured';
	print_r($res['error']);

}

// Print the entire output just incase !
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
    [timenow] => 1765351406
    [time_taken] => 1.188
)

.........

```

## Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | staging   | The value should be “staging” for softaculous to perform the action of staging an installation.   |
| insid    | 26_12345   | Installation ID of the installation that you want to create staging copy for. It can be fetched from List Installed Script  |
| **Post** |
| softsubmit    | 1   | This will trigger the Staging  |
| softdomain    | domain.com   | This is the domain on which you wish to create the staging |
| softdirectory    | wp   | 	This is the sub-directory to create the staging. Leave it blank to create staging in root of the domain  |
| softdb    | wp123   | This is the database name for the created staging installation. If the script does not require database you can leave this blank.  |
