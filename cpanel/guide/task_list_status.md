## Task list Status using Softaculous API Guide
This guide explains how to check the task list status using Softaculous API.

### via cURL
```php
curl "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=eu_tasklist&ssk=abcdefghijklmnopqrstuvwxyz0123456789&api=json"
```

### via PHP script

```php

<?php

// The URL
$url = 'https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?'.
        			'&api=serialize'.
        			'&act=eu_tasklist'.
        			'&ssk=abcdefghijklmnopqrstuvwxyz0123456789';


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
$res = unserialize($resp);

print_r($res);

?>
```
### Expected response
```php
Array (     
      [title] => Softaculous - Task List
      [status] => Array         
                   (             
                       [process] =>              
                       [current_status] => Propagating the database
                       [sid] => 26
                       [name] => WordPress             
                       [version] => 4.7.5             
                       [softurl] => https://domain.com/
                       [completed] => Installation Completed
                       [progress] => 100         
                    )     
      [no_tasks] =>      
      [tasks_file] =>      
      [timenow] => 1496828740     
      [time_taken] => 0.001 
) 

```

### Required Parameters

| Key | Value | Description |
|----------|----------|----------|
| Authentication    | -   | You can use the Enduser Authenticating methods. |
| act | eu_tasklist | The value should be “eu_tasklist” to perform the action to get the status of the task. |
| ssk | abcdefghijklmnopqrstuvwxyz0123456789 | The ssk is the status file. |
