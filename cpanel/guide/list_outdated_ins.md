## Installations backup using Softaculous API Guide
This guide explains how to install a script using Softaculous API.

### via cURL
```php
curl "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=installations&showupdates=true&api=json"
```

### via PHP script

```php

<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
        			'&api=serialize'.
        			'&act=installations'.
        			'&showupdates=true';


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

print_r($res['installations']);

?>
```
### Expected response
```php
Array
(
    [title] => Softaculous - Powered by Softaculous
    [installations] => Array
        (
            [26] => Array
                (
                    [26_12345] => Array
                        (
                            [sid] => 26
                            [ver] => 5.7.14
                            [itime] => 1766041071
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
                            [softdbpass] => ********
                            [dbprefix] => wp2p_
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
                                    [19] => .htaccess
                                    [20] => wp-config.php
                                )

                            [site_name] => My Blog
                            [insid] => 26_12345
                            [display_softdbpass] => ********
                            [script_name] => WordPress
                        )

                )

        )

    [timenow] => 1766041085
    [time_taken] => 0.072
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | installations  | The value should be “installations” to perform the action of listing installations. |
| showupdates  | true  | The value should be “true” if you want to list only installations that have an update available for Softaculous to perform the action of listing installations.  |
