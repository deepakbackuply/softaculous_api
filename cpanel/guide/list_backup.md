## List backup using Softaculous API Guide
This guide explains how to fetch the backup list using Softaculous API.

### via cURL
```php
curl "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=backups&api=json"
```

### via PHP script

```php

<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=backups';


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

print_r($res['backups']);

?>
```
### Expected response
```php
Array
(
    [title] => Softaculous - Powered by Softaculous
    [backups] => Array
        (
            [26] => Array
                (
                    [26_17652] => Array
                        (
                            [0] => Array
                                (
                                    [name] => wp.26_17652.2025-12-17_17-48-57.tar.gz
                                    [path] => /home/user/softaculous_backups/
                                    [size] => 23913793
                                    [sid] => 26
                                    [ver] => 6.10
                                    [itime] => 1765968147
                                    [softpath] => /home/user/public_html/wp
                                    [softurl] => https://domain.com/wp
                                    [adminurl] => wp-admin/
                                    [disable_wp_cron] => 
                                    [admin_username] => admin
                                    [admin_email] => admin@domain.com
                                    [softdomain] => domain.com
                                    [softdb] => wp60378
                                    [softdbuser] => wp60378
                                    [softdbhost] => localhost
                                    [softdbpass] => *********
                                    [dbprefix] => wpjg_
                                    [dbcreated] => 1
                                    [fileindex] => Array()
                                    [site_name] => My Blog
                                    [insid] => 26_12345
                                    [script_name] => WordPress
                                    [display_softdbpass] => ********
                                    [backup_db] => 1
                                    [backup_dir] => 1
                                    [backup_datadir] => 0
                                    [backup_wwwdir] => 0
                                    [ssk] => uGIdca1kF3zLFlLtGymnRLLpICY
                                    [soft_version] => 6.3.1
                                    [btime] => 1765973937
                                    [ext] => tar.gz
                                )

                            [1] => Array
                                (
                                    [name] => wp.26_17652.2025-12-17_17-29-48.tar.gz
                                    [path] => /home/user/softaculous_backups/
                                    [size] => 23926964
                                    [sid] => 26
                                    [ver] => 6.10
                                    [itime] => 1765968147
                                    [softpath] => /home/user/public_html/moodle
                                    [softurl] => https://domain.com/moodle
                                    [adminurl] => wp-admin/
                                    [disable_wp_cron] => 
                                    [admin_username] => admin
                                    [admin_email] => admin@domain.com
                                    [softdomain] => domain.com
                                    [softdb] => wp456
                                    [softdbuser] => wp456
                                    [softdbhost] => localhost
                                    [softdbpass] => *********
                                    [dbprefix] => wpjg_
                                    [dbcreated] => 1
                                    [fileindex] => Array()
								    [site_name] => My Blog
                                    [insid] => 26_12345
                                    [script_name] => WordPress
                                    [display_softdbpass] => *******
                                    [backup_db] => 1
                                    [backup_dir] => 1
                                    [backup_datadir] => 
                                    [backup_wwwdir] => 
                                    [backup_note] => 
                                    [ssk] => P2OlmkM2GI4kelYLzsOSEzaMfu
                                    [soft_version] => 6.3.1
                                    [btime] => 1765972788
                                    [ext] => tar.gz
                                )

                        )

                )

        )

    [timenow] => 1766041709
    [time_taken] => 0.082
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | backup   | The value should be “backups” to perform the action of listing backups. |
