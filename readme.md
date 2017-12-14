# Laravel Harvest
**A wrapper for the [Harvest API](https://help.getharvest.com/api-v2/).**

## Install

`composer require naoray/laravel-harvest`

*If you want to persist harvest data, publish the migration:*
`php artisan vendor:publish --provider="Naoray\LaravelHarvest\LaravelHarvestServiceProvider`

*If you only want to publish the config file add:* `--tag="config"`

## Usage

**Clients**
```php
// get Clients with Facade
$result = Harvest::getClients();

// get Clients via ApiManager
$manager = app()->make('harvest');

$result = $manager->clients->all();


// get Clients by Id
Harvest::getClientsById('12345')->toJson();
$manager->clients->id('12345')->toJson();
```

**Contacts**
```php
// get Contacts with Facade
$result = Harvest::getContacts();

// get Contacts via ApiManager
$manager = app()->make('harvest');

$result = $manager->contacts->all();


// get Contacts by Id
Harvest::getContactsById('12345')->toJson();
$manager->contacts->id('12345')->toJson();
```

**Users**
```php
// get Users with Facade
$result = Harvest::getUsers();

// get Users via ApiManager
$manager = app()->make('harvest');

$result = $manager->users->all();


// get Users by Id
Harvest::getUsersById('12345')->toJson();
$manager->users->id('12345')->toJson();
```


**Converting Results**
```php
$result = Harvest::getUsers();

// convert result to json
$result->toJson();
// convert result to collection
$result->toCollection();
// convert result to paginated collection
$result->toPaginatedCollection();
```

## Data not Stored
- 

## ToDo
- add usage sections to readme
- update/create records
- tests