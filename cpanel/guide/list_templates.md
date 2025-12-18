## List templates using Softaculous API Guide

This document explains how to list all templates using the Softaculous API.


### via cURL
```php
curl "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=templates&api=json"
```

### via PHP script

```php

<?php

/// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
          			'&api=serialize'.
          			'&act=templates';

// Set the curl parameters.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Turn off the server and peer verification (TrustManager Concept).
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
 
// Get response from the server.
$resp = curl_exec($ch);

// The response will hold a string as per the API response method. In this case its PHP Serialize
$res = unserialize($resp);
 
// Done ?
if(!empty($res['done'])){

	print_r($res['templates']);

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
    [title] => Softaculous - Powered by Softaculous
    [templates] => Array
        (
            [26] => Array
                (
                    [0] => Array
                        (
                            [name] => my-template.tar.gz
                            [path] => /home/user/softaculous_templates/
                            [size] => 33671877
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
                            [softdb] => wp123
                            [softdbuser] => wp123
                            [softdbhost] => localhost
                            [softdbpass] => *******
                            [dbprefix] => wphh_
                            [dbcreated] => 1
                            [fileindex] => Array()...
                            [site_name] => My Blog
                            [insid] => 26_12345
                            [script_name] => WordPress
                            [backup_db] => 1
                            [backup_dir] => 1
                            [backup_datadir] => 0
                            [backup_wwwdir] => 0
                            [backup_note] => 
                            [ssk] => DOA1GnzLNiFyHaXbw0KW7Zoj2
                            [soft_version] => 6.3.1
                            [btime] => 1766058135
                            [ext] => tar.gz
                            [template_name] => my-template
                            [template_type] => 1
                            [disallow_plugins] => 1
                            [backup_location] => 0
                        )

                )

            [621] => Array
                (
                    [0] => Array
                        (
                            [name] => moodle.tar.gz
                            [path] => /home/user/softaculous_templates/
                            [size] => 29874013
                            [sid] => 621
                            [ver] => 6.5.4
                            [itime] => 1766044643
                            [softpath] => /home/user/public_html/moodle
                            [softurl] => http://domain.com/moodle
                            [adminurl] => Login.php
                            [softdomain] => domain.com
                            [softdb] => mood981
                            [softdbuser] => mood981
                            [softdbhost] => localhost
                            [softdbpass] => *******
                            [dbcreated] => 1
                            [fileindex] => Array()....
                            [admin_username] => admin
                            [insid] => 542_12345
                            [script_name] => Moodle
                            [backup_db] => 1
                            [backup_dir] => 1
                            [backup_datadir] => 0
                            [backup_wwwdir] => 0
                            [backup_note] => 
                            [ssk] => J3Q3OAhp7x5ywpLQZTT5DBSjHF
                            [soft_version] => 5.1.1
                            [btime] => 1766059194
                            [ext] => tar.gz
                            [template_name] => moodle
                            [template_type] => 1
                            [backup_location] => 0
                        )

                )

        )

    [timenow] => 1766059218
    [time_taken] => 0.113
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | templates   | The value should be “templates” to perform the action of listing templates. |
