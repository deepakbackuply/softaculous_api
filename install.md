# Install Script via API

This document explains how to install a script using Softaculous API.


## Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | software, js, perl   | The value should be “software” to install PHP script, “js” to install a JavaScript and “perl” to install a PERL script for softaculous to perform the action of installing a software.   |
| soft    | 26 (26 is the Script ID of WordPress)   | The value should be “SID” for softaculous to perform the action of installing a software. You can find the list of sid’s here   |
| POST    |    |    |
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |


## via CuRL
curl -d "softsubmit=1" -d "softdomain=example.com" -d "softdirectory=wp" -d "softdb=wpdb" -d "admin_username=admin" -d "admin_pass=adminpassword" -d "admin_email=admin@example.com" -d "language=en" -d "site_name=Wordpress Site" -d "site_desc=My Blog" -d "dbprefix=dbpref_" -d "sets_name[]=set-name" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=software&soft=26&api=json"

## via PHP script

```php
<?php

$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=software'.
                        '&soft=26';

$post = array('softsubmit' => '1',
              'softdomain' => 'example.com', // Must be a valid Domain
              'softdirectory' => 'wp', // Keep empty to install in Web Root
              'softdb' => 'wpdb',
              'admin_username' => 'admin',
              'admin_pass' => 'adminpassword',
              'admin_email' => 'admin@example.com',
              'language' => 'en',
              'site_name' => 'WordPress Site',
              'site_desc' => 'My Blog',
              'dbprefix' => 'dbpref_',
              'sets_name[]' => 'set-name'
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

	print_r($res);

// Error
}else{

	echo 'Some error occured';
	print_r($res['error']);

}
?>
```
### expected output of $resp
```php
Array
(
    [title] => Softaculous 
    [done] => 1
    [info] => Array
        (
            [overview] => WordPress is web software you can use to create a beautiful website or blog. We like to say that WordPress is both free and priceless at the same time.
            [install] => 
            [features] => WordPress powers more than 23% of the web - a figure that rises every day. Everything from simple websites, to blogs, to complex portals and enterprise websites, and even applications, are built with WordPress.
            [demo] => http://www.softaculous.com/demos/WordPress
            [ratings] => http://www.softaculous.com/softwares/blogs/WordPress
            [support] => http://www.wordpress.org/
            [release_date] => 30-09-2025
            [mod] => 254
            [mod_files] => 
            [import] => 1
        )

    [settings] => Array
        (
            [Database Settings] => Array
                (
                    [dbprefix] => Array
                        (
                            [tag] => wp_
                            [head] => Table Prefix
                            [exp] => 
                            [handle] => 
                            [optional] => 1
                            [quick_install] => 
                            [minlen] => 
                            [orig_val] => wp_
                        )

                )

            [Site Settings] => Array
                (
                    [site_name] => Array
                        (
                            [tag] => My Blog
                            [head] => Site Name
                            [exp] => 
                            [handle] => 
                            [optional] => 
                            [quick_install] => 
                            [minlen] => 
                            [orig_val] => My Blog
                        )

                    [site_desc] => Array
                        (
                            [tag] => My WordPress Blog
                            [head] => Site Description
                            [exp] => 
                            [handle] => 
                            [optional] => 1
                            [quick_install] => 
                            [minlen] => 
                            [orig_val] => My WordPress Blog
                        )

                    [multisite] => Array
                        (
                            [tag] => 
                            [head] => Enable Multisite (WPMU)
                            [exp] => This feature will Enable Multisite option for your WordPress blog.
                            [handle] => 
                            [optional] => 
                            [quick_install] => 
                            [minlen] => 
                            [admintag] => 1
                            [enabled] => 1
                            [editable] => 1
                        )

                    [disable_wp_cron] => Array
                        (
                            [save] => 1
                            [tag] => 
                            [head] => Disable WordPress Cron
                            [exp] => If selected, WordPress cron will be disabled and a cron job will be added in your control panel to be executed twice an hour.
                            [handle] => 
                            [optional] => 
                            [quick_install] => 
                            [minlen] => 
                            [admintag] => 1
                            [enabled] => 1
                            [editable] => 1
                        )

                )

            [Admin Account] => Array
                (
                    [admin_username] => Array
                        (
                            [save] => 1
                            [tag] => admin
                            [head] => Admin Username
                            [exp] => 
                            [handle] => __admin_username
                            [optional] => 
                            [quick_install] => 1
                            [minlen] => 
                            [orig_val] => admin
                        )

                    [admin_pass] => Array
                        (
                            [tag] => pass
                            [head] => Admin Password
                            [exp] => 
                            [handle] => __ad_pass
                            [optional] => 
                            [quick_install] => 1
                            [minlen] => 
                            [orig_val] => pass
                        )

                    [admin_email] => Array
                        (
                            [save] => 1
                            [tag] => admin
                            [head] => Admin Email
                            [exp] => 
                            [handle] => __email_address
                            [optional] => 
                            [quick_install] => 1
                            [minlen] => 
                            [orig_val] => admin
                        )

                )

            [Select Plugins] => Array
                (
                    [softaculous-pro] => Array
                        (
                            [tag] => 
                            [head] => AI, Assistant, Onboarding
                        )

                    [cookieadmin] => Array
                        (
                            [tag] => 
                            [head] => Cookie Consent Banner
                        )

                    [backuply] => Array
                        (
                            [tag] => 
                            [head] => Backups
                        )

                    [speedycache] => Array
                        (
                            [tag] => 
                            [head] => Improve Page Speed
                        )

                    [siteseo] => Array
                        (
                            [tag] => 
                            [head] => Improve Website Ranking
                        )

                    [loginizer] => Array
                        (
                            [tag] => 
                            [head] => Limit Login Attempts
                        )

                    [pagelayer] => Array
                        (
                            [tag] => 
                            [head] => Drag and Drop website builder
                        )

                    [gosmtp] => Array
                        (
                            [tag] => 
                            [head] => Email with SMTP
                        )

                    [fileorganizer] => Array
                        (
                            [tag] => 
                            [head] => File Manager
                        )

                )

            [Extended Settings] => Array
                (
                    [language] => Array
                        (
                            [tag] => English
                            [head] => Select Language
                            [exp] => 
                            [handle] => 
                            [optional] => 
                            [quick_install] => 
                            [minlen] => 
                            [orig_val] => Array
                                (
                                    [0] => en
                                    [1] => ar
                                    [2] => sq
                                    [3] => bg_BG
                                    [4] => ca
                                    [5] => zh_CN
                                    [6] => zh_TW
                                    [7] => hr
                                    [8] => cs_CZ
                                    [9] => da_DK
                                    [10] => nl_NL
                                    [11] => fi
                                    [12] => fr_FR
                                    [13] => de_DE
                                    [14] => el
                                    [15] => he_IL
                                    [16] => hu_HU
                                    [17] => id_ID
                                    [18] => it_IT
                                    [19] => ja
                                    [20] => ko_KR
                                    [21] => nb_NO
                                    [22] => fa_IR
                                    [23] => pl_PL
                                    [24] => pt_PT
                                    [25] => pt_BR
                                    [26] => ro_RO
                                    [27] => ru_RU
                                    [28] => sl_SI
                                    [29] => sk_SK
                                    [30] => es_ES
                                    [31] => sv_SE
                                    [32] => th
                                    [33] => tr_TR
                                    [34] => uk
                                    [35] => vi
                                    [36] => zh_HK
                                )

                        )

                )

        )

    [dbtype] => mysql
    [__settings] => Array
        (
            [adminurl] => wp-admin/
            [softdomain] => yourdomain.com
            [softdirectory] => wpapi4
            [softpath] => /home/user/public_html/wp
            [softurl] => http://yourdomain.com/wp
            [softdb] => wpdb4
            [softdbuser] => wpdb4
            [softdbhost] => localhost
            [softdbpass] => **********
            [dbprefix] => dbpref_
            [site_name] => WordPress Site
            [site_desc] => My Blog
            [multisite] => 
            [disable_wp_cron] => 
            [admin_username] => admin
            [admin_pass] => **********
            [admin_email] => admin@example.com
            [softaculous-pro] => 
            [cookieadmin] => 
            [backuply] => 
            [speedycache] => 
            [siteseo] => 
            [loginizer] => 
            [pagelayer] => 
            [gosmtp] => 
            [fileorganizer] => 
            [language] => 
            [fileindex] => Array
                (
                    [index.php] => index.php
                    [license.txt] => license.txt
                    [readme.html] => readme.html
                    [wp-activate.php] => wp-activate.php
                    [wp-admin] => wp-admin
                    [wp-blog-header.php] => wp-blog-header.php
                    [wp-comments-post.php] => wp-comments-post.php
                    [wp-config-sample.php] => wp-config-sample.php
                    [wp-content] => wp-content
                    [wp-cron.php] => wp-cron.php
                    [wp-includes] => wp-includes
                    [wp-links-opml.php] => wp-links-opml.php
                    [wp-load.php] => wp-load.php
                    [wp-login.php] => wp-login.php
                    [wp-mail.php] => wp-mail.php
                    [wp-settings.php] => wp-settings.php
                    [wp-signup.php] => wp-signup.php
                    [wp-trackback.php] => wp-trackback.php
                    [xmlrpc.php] => xmlrpc.php
                    [wp-config.php] => wp-config.php
                    [.htaccess] => .htaccess
                )

            [punycode_softurl] => http://yourdomain.com/wp
            [timestamp] => 1764062056
            [regtime] => 2025-11-25 14:44:16
            [relativeurl] => /wp
            [domhost] => yourdomain.com
            [gmt_offset] => 5.5
            [random_seed] => nlgirjmrsmh5msgvohhrff7npwoo2gb9
            [secret] => wkjnsvokgcwyoyist73rbu8bkl1vzxq52dhjhgkz6rj7xkg9fpavnixupjhd95pigwhg
            [auth_salt] => 28dyyn6nymya
            [logged_in_salt] => ns4drkkbfusv
            [date_gmt] => 2025-11-25 09:14:16
            [date] => 2025-11-25 14:44:16
            [user_len] => 5
            [site_admins] => s:5:"admin";
            [wpver] => 6.8.3
            [_transient_doing_cron] => 1764062056.2620229721069335937500
            [timestamp_nextday] => 1764148456
            [admin_email_lifespan] => 1779614056
            [admin_pass_plain] => password
            [utf8] => utf8mb4
            [collate] => utf8mb4_unicode_520_ci
            [WPLANG] => en_US
            [active_plugins] => a:0:{}
            [permalink_structure] => /%year%/%monthnum%/%day%/%postname%/
        )

    [software] => Array
        (
            [name] => WordPress
            [softname] => wp
            [desc] => WordPress is a state-of-the-art publishing platform with a focus on aesthetics, web standards, and usability.
            [ins] => 1
            [cat] => blogs
            [type] => php
            [ver] => 6.8.3
            [pre_down] => 1
            [path] => /var/softaculous/wp
            [has_theme] => WordPress
            [update_plugins] => 1
            [update_themes] => 1
            [verify_dom] => 0
            [has_minor] => 1
            [idn_dir] => 1
            [spacereq] => 75173921
            [adminurl] => wp-admin/
        )

    [notes] => 
    [cron] => 
    [datadir] => 
    [overwrite_option] => 
    [protocols] => Array
        (
            [1] => http://
            [2] => http://www.
            [3] => https://
            [4] => https://www.
        )

    [nopackage] => 0
    [theme_package] => 
    [insid] => 26_50414
    [timenow] => 1764062058
    [time_taken] => 8.527
)
