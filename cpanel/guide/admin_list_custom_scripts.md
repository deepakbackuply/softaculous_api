## List custom script Softaculous API Guide
This guide explains how to list custom script using Softaculous API.

### via cURL
```php

curl "https://user:password@domain.com:2087/url/to/softaculous/index.php?act=customscripts&api=json"

```
### via PHP script

```php

<?php

// URL
$url = 'http://admin.controlpanel.com:PORT/url/to/softaculous/index.php?'.
    			'&api=serialize'.
    			'&act=customscripts';

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
    [title] => Softaculous - Admin Panel
    [cscripts] => Array
        (
            [10001] => Array
                (
                    [name] => CUSTOM SCRIPT
                    [softname] => custom
                    [desc] => My Custom Script
                    [ins] => 1
                    [cat] => blogs
                    [type] => php
                    [ver] => 1.0
                    [parent] => 0
                )
            [10002] => Array
                (
                    [name] => CUSTOM SCRIPT 2
                    [softname] => custom2
                    [desc] => My Custom Script 2
                    [ins] => 1
                    [cat] => blogs
                    [type] => php
                    [ver] => 1.0
                    [parent] => 0
                )
        )
    [custom_catwise] => Array
        (
            [php] => Array
                (
                    [blogs] => Array
                        (
                            [10001] => Array
                                (
                                    [name] => CUSTOM SCRIPT
                                    [softname] => custom
                                    [desc] => My Custom Script
                                    [ins] => 1
                                    [cat] => blogs
                                    [type] => php
                                    [ver] => 1.0
                                    [parent] => 0
                                )

                            [10002] => Array
                                (
                                    [name] => CUSTOM SCRIPT 2
                                    [softname] => custom2
                                    [desc] => My Custom Script 2
                                    [ins] => 1
                                    [cat] => blogs
                                    [type] => php
                                    [ver] => 1.0
                                    [parent] => 0
                                )
                        )
                )
        )

    [timenow] => 1776088449
    [time_taken] => 0.001
)

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act  | customscripts   |	The value should be “customscripts” to perform the action of listing the custom script. |
