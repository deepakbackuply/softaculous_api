## Push the installation to their live site(Customize Options) using Softaculous API guide

This guide explains how to push the site to its live site using Softaculous API.


### via cURL
```php
curl -d "softsubmit=1" -d "custom_push=1" -d "overwrite_files=1" -d "push_db=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=pushtolive&insid=26_12345&api=json"
```

### via PHP script

```php
<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			      '&api=serialize'.
			      '&act=pushtolive'.
  				  '&insid=26_12345';

$post = array('softsubmit' => '1',
              'custom_push' => '1', 
              'overwrite_files' => '1', //This will push the files
              'push_db' => '1', //Push full database
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
if(!empty($res['done'])){

	echo 'The Staging installation has been pushed successfully to live installation : '.$res['__settings']['softurl'];

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
The Staging installation has been pushed successfully to live installation : https://domain.com
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done_msg] => Pushing to live has started in background
    [done] => abc5wB4xNJJenDy1QjdK1QnrwcfYd
    [userins] => Array
        (
            [sid] => 26
            [ver] => 6.9
            [itime] => 1765972693
            [softpath] => /home/user/public_html
            [softurl] => https://domain.com
            [admin_folder] => wp-admin/
            [site_name] => My Blog
            [softdomain] => domain.com
            [softdb] => wp582
            [softdbuser] => wp582
            [softdbhost] => localhost
            [softdbpass] => *********
            [dbcreated] => 1
            [dbprefix] => wpjg_
            [fileindex] => Array...............

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | pushtolive   | The value should be “pushtolive” for softaculous to perform the action of pushtolive the staging installation.  |
| insid    | 26_12345   | The installation ID that you want to pushtolive.  |
| **POST**    |
| softsubmit  | 1   | This will trigger the pushtolive function   |
| custom_push  | 1   | This will trigger the advanced push where you can select to push files or database(full database and table structures or tables data)   |
| overwrite_files  | 1   | 	This will overwrite all the files of your live installation with the ones in Staging installation.  |
| push_db  | 1   | 	This will erase the live database and import the full database from your staging installation.  |
| structural_change_tables  | array(‘wptd_posts’,’wptd_users’)  | (Optional) – This will be the array to push tables having structural changes.   |
| datachange_tables  | array(‘wptd_posts’,’wptd_users’)   | (Optional) – This will be the array to push tables having data changes.   |
| push_views  | 1   | (Optional) – This will push all “views” from your staging installation to live site.   |
