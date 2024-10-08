# PHP library for Ascory
> [!WARNING]
> The library was created by Ascory users. No assistance may be provided for this repository. By using this code, you automatically agree to the MIT license.
## Installation
Upload the `ascory.php` file to your scripts folder.
## Usage
Declare an Ascory class:
```php
<?php
include("ascory.php");
$shop = 1; # Shop ID
$key1 = "c0a9cc6d8d4243c4a644f8e57d085438"; # First shop key
$key2 = "56d4f8ee1ee480707ee9f3210da5aca2"; # Second shop key
$ascory = new Ascory($shop, $key1, $key2);
```
## API Documentation
### Item
#### Create
```php
$ascory->createItem([
  "name" => "Apple", # Item name (5 to 30 characters)
  "description" => "Delicious Apple", # Item description (5 to 50 characters)
  "amount" => 0.5 # Item price in dollars (number to hundredths from 0.1 to 100)
]);
```
#### Check
```php
$ascory->item->check([
  "id" => 1 # Item ID
]);
```
#### Delete
```php
$ascory->item->delete([
  "id" => 1 # Item ID
]);
```
