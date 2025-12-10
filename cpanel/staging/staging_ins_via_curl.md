## Staging an Installed Script via cURL

```php
curl -d "softsubmit=1" -d "softdomain=domain.com" -d "softdirectory=wp" -d "softdb=wpdb" "https://user:password@domain.com:2083/frontend/jupiter/softaculous/index.live.php?act=staging&insid=26_12345&api=json"
```
