# Laravel Harvest
**A wrapper for the [Harvest API](https://help.getharvest.com/api-v2/).**

<a name="install" />

## Install

`composer require naoray/laravel-harvest`

*If you want to persist harvest data, publish the migration:*
`php artisan vendor:publish --provider="Naoray\LaravelHarvest\LaravelHarvestServiceProvider`

*If you only want to publish the config file add:* `--tag="config"`

## Table of Content
- [Install](#install)
- [Clients](#clients)

## Usage
You can use either the `Harvest` facade or the Api Manager for any request.
```php
// instantiate api manager
$manager = app()->make('harvest');
```

<a name="clients"/>**Clients**
```php
// get Clients with Facade
$result = Harvest::getClients();

// get Clients via ApiManager
$result = $manager->clients->all();

// get Clients by Id
Harvest::getClientsById('12345');
$manager->clients->id('12345');
```

**Company**
```php
// get Clients with Facade
$result = Harvest::getCompany();

// get Clients via ApiManager
$result = $manager->company->all();
```

**Contacts**
```php
// get Contacts with Facade
$result = Harvest::getContacts();

// get Contacts via ApiManager
$result = $manager->contacts->all();


// get Contacts by Id
Harvest::getContactsById('12345');
$manager->contacts->id('12345');
```

**Estimate**
```php
// get Estimates with Facade
$result = Harvest::getEstimates();

// get Estimates via ApiManager
$result = $manager->estimates->all();


// get Estimate by Id
Harvest::getEstimateById('12345');
$manager->estimates->id('12345');
```

**Users**
```php
// get Users with Facade
$result = Harvest::getUsers();

// get Users via ApiManager
$result = $manager->users->all();

// get Users by Id
Harvest::getUsersById('12345');
$manager->users->id('12345');

// get current user
Harvest::getCurrentUser();
$manager->user->me();
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

// get next result page
$result = $result->next();
// get prev result page
$result = $result->previous();
```

## ToDo
- add usage sections to readme
- update/create records
- tests