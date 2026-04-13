## Edit custom script Softaculous API Guide
This guide explains how to edit custom script using Softaculous API.

### via cURL
```php

curl -d "csname=Custom Script" -d "softname=custom" -d "desc=My Custom Script" -d "ver=1.0" -d "cat=blogs" -d "parent=10002" -d "edit_submit=1" "https://user:password@domain.com:2087/url/to/softaculous/index.php?act=customscripts&sact=edit&sid=10001&api=json"
```
### via PHP script

```php

<?php

// URL
$url = 'http://admin.controlpanel.com:PORT/url/to/softaculous/index.php?'.
              '&api=serialize'.
              '&act=customscripts'.
              '&sact=edit'.
              '&sid=10001';

$post = array('csname' => 'CUSTOM SCRIPT', //Name of your custom script
              'softname' => 'custom', //Name of the custom script folder
              'desc' => 'My Custom Script', //Description of custom script
              'ver' => '1.0', //Version of custom script
              'cat' => 'blogs', //Category
              'parent' => '10002', //Parent sid
              'edit_submit' => '1'
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
    [done] => 1
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
                    [parent] => 10001
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
                        )
                )
        )
    [timenow] => 1776086170
    [time_taken] => 0.005
)
```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating or Admin Authentication methods.   |
| act  | customscripts   |	The value should be “customscripts” to perform the action of editing a custom script. |
| sact  | edit |	The value should be “edit” to edit the custom script. |
| sid  | 10001 |	Here 10001 is the sid or script id of your custom script. The sid can be fetch from List Custom Scripts |
| **POST** |
| csname | CUSTOM-SCRIPT-NAME | The value must be name of your custom script |
| softname | custom-script | The value must be folder name of the custom script package |
| desc | Description | The value must be the description of your custom script |
| ver | 1.0 | The value must be the version of your custom script |
| cat | Category | The value must be the category of your custom script. For example, Blogs, Ecommerce etc. |
| parent | 10002 | (OPTIONAL) – The value must be sid of your parent script, in case if you want to set your custom script as child. The parent sid can be fetch from List Custom Scripts |
| edit_submit | 1 | This will trigger the action of editing the custom script |
