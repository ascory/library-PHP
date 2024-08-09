# PHP library for Ascory
> [!WARNING]
> The library was created by Ascory users. No assistance may be provided for this repository. By using this code, you automatically agree to the MIT license.
# Installation
1. Upload the `ascory.php` file to your scripts folder.
2. Declare an Ascory class:
```php
<?php
include("ascory.php");
$shop = 1;
$key1 = "c0a9cc6d8d4243c4a644f8e57d085438";
$key2 = "56d4f8ee1ee480707ee9f3210da5aca2";
$ascory = new Ascory($shop, $key1, $key2);
```
