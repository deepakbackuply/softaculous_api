## List all outdated installations using Softaculous API Guide
This guide explains how to fetch all outdated installation list using Softaculous API.

### via cURL
```php

curl -d "listinstallations=1" "https://user:password@domain.com:2087/url/to/softaculous/index.php?act=installations&show=outdated&api=json"

```

### via PHP script

```php

// URL
$url = 'http://admin.controlpanel.com:PORT/url/to/softaculous/index.php?'.
			'&api=serialize'.
			'&act=installations'.
			'&show=outdated';

$post = array('listinstallations' => 1,
              //'users' => 'root;user1;', // Pass this if you want the installation list of specific users
              //'scripts' => 'WordPress;Joomla;', // Pass this if you want the installation list of specific scripts
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
 
// The response will hold a string as per the API response method. In this case its PHP Serialize
$res = unserialize($resp);
 
// Done ?
if(!empty($res)){

	print_r($res);

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
    [26] => Array
        (
            [26_45678] => Array
                (
                    [sid] => 26
                    [ver] => 6.7.4
                    [itime] => 1766039749
                    [softpath] => /home/user/public_html/wp
                    [softurl] => https://domain.com/wp
                    [adminurl] => wp-admin/
                    [disable_wp_cron] => 
                    [admin_username] => admin
                    [admin_email] => admin@domain.com
                    [softdomain] => domain.com
                    [softdb] => wp118
                    [softdbuser] => wp118
                    [softdbhost] => localhost
                    [softdbpass] => *********
                    [dbprefix] => wphh_
                    [dbcreated] => 1
                    [fileindex] => Array()
                    [site_name] => My Blog
                    [insid] => 26_45678
                    [display_softdbpass] => *******
                    [script_name] => WordPress
                )
        )
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | installations   | 	This will trigger the list installations function. |
| show    | outdated   | 	This will trigger the outdated installations list function |
| **POST** |
| listinstallations  | 1 | This will trigger the listinstallations function |
| users  | root;user1; | (Optional) Pass ; separated list of users to filter installations by users |
| scripts | WordPress;Joomla; | (Optional) Pass ; separated list of scripts to filter installations by scripts |
