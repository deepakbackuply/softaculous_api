## Push the installation to their live site(Default Options) using Softaculous API guide

This guide explains how to push the site to its live site using Softaculous API.


## via cURL
```php
curl -d "softsubmit=1" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=pushtolive&insid=26_12345&api=json"
```

## via PHP script

```php
// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
			'&api=serialize'.
			'&act=pushtolive'.
      		'&insid=26_12345';

$post = array('softsubmit' => '1');

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

	echo 'The Staging installation has been pushed successfully to live installation : '.$res['liveins']['softurl'];

// Error
}else{

	echo 'Some error occured';
	print_r($res['error']);

}

// Print the entire output just incase !
print_r($res);
```
### Expected response
```php
The Staging installation has been pushed successfully to live installation : https://domain.com
Array
(
    [title] => Softaculous - Powered by Softaculous
    [done_msg] => Pushing to live has started in background
    [done] => GDjFLxMwpkp6GmA0C4JOYdNyffmS
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
            [softdbpass] => ********
            [dbcreated] => 1
            [dbprefix] => wpjg_
            [fileindex] => Array...............

```

## Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act    | pushtolive   | The value should be “pushtolive” for softaculous to perform the action of pushtolive the staging installation.  |
| insid    | 26_12345   | The installation ID that you want to pushtolive.  |
| **POST**    |
| softsubmit  | 1   | This will trigger the pushtolive function   |
