#  A Laravel wrapper for the [Harvest API](https://help.getharvest.com/api-v2/)

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Travis](https://img.shields.io/travis/byte5digital/laravel-harvest.svg?style=flat-square)]()
[![Total Downloads](https://img.shields.io/packagist/dt/byte5digital/laravel-harvest.svg?style=flat-square)](https://packagist.org/packages/byte5digital/laravel-harvest)


<a name="install" />

## Install
`composer require byte5digital/laravel-harvest`

*If you want to persist harvest data, publish the migration:*
`php artisan vendor:publish --provider="Byte5\LaravelHarvest\LaravelHarvestServiceProvider`

*If you only want to publish the config file add:* `--tag="config"`

## Table of Content
- [Install](#install)
- [Usage](#usage)
    + [Clients](#clients)
    + [Company](#company)
    + [Contacts](#contacts)
    + [Estimates](#estimates)
    + [Expenses](#expenses)
    + [Expense Categories](#expense-categories)
    + [Users](#users)
    + [Converting Results](#converting)

<a name="usage" />

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

<a name="company"/>**Company**
```php
// get Clients with Facade
$result = Harvest::getCompany();

// get Clients via ApiManager
$result = $manager->company->all();
```

<a name="contacts"/>**Contacts**
```php
// get Contacts with Facade
$result = Harvest::getContacts();

// get Contacts via ApiManager
$result = $manager->contacts->all();


// get Contacts by Id
Harvest::getContactsById('12345');
$manager->contacts->id('12345');
```

<a name="estimates"/>**Estimates**
```php
// get Estimates with Facade
$result = Harvest::getEstimates();

// get Estimates via ApiManager
$result = $manager->estimates->all();


// get Estimate by Id
Harvest::getEstimateById('12345');
$manager->estimates->id('12345');
```

<a name="expenses"/>**Expenses**
```php
// get Expenses with Facade
$result = Harvest::getExpenses();

// get Expenses via ApiManager
$result = $manager->expenses->all();

// get Expense by Id
Harvest::getExpenseById('12345');
$manager->expenses->id('12345');
```

<a name="expense-categories"/>**Expense Categories**
```php
// get Expense Category with Facade
Harvest::getExpenseCategorie);

// get Expense Category via ApiManager
$result = $manager->expenses->al);

// get Expense Category by Id
Harvest::getExpenseCategoryById('12345');
$manager->expenseCategory->id('12345');
```

<a name="users"/>**Users**
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


<a name="converting"/>**Converting Results**
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

## Testing
Run the tests with:

``` bash
vendor/bin/phpunit
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security
If you discover any security-related issues, please email kkoenig@byte5.de instead of using the issue tracker.

## License
The MIT License (MIT). Please see [License File](/LICENSE.md) for more information.