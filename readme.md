#  A Laravel wrapper for the [Harvest API](https://help.getharvest.com/api-v2/)

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Travis](https://img.shields.io/travis/byte5digital/laravel-harvest.svg?style=flat-square)]()
[![StyleCI](https://styleci.io/repos/114007216/shield?branch=master)](https://styleci.io/repos/114007216)
[![Total Downloads](https://img.shields.io/packagist/dt/byte5digital/laravel-harvest.svg?style=flat-square)](https://packagist.org/packages/byte5digital/laravel-harvest)

A small wrapper for the harvest API which aims to make your life more easier.

*Currently it is only possible to receive data from harvest with this package but not to create content.*

## Install

#### Laravel Version 5.6+
`composer require byte5digital/laravel-harvest`

#### Laravel Version 5.5
`composer require byte5digital/laravel-harvest:2.0`

*If you want to store harvest data into your database, set the `uses_database` in the `harvest` config to `true` and publish the migrations:*

`php artisan vendor:publish --provider="Byte5\LaravelHarvest\LaravelHarvestServiceProvider`

*If you only want to publish the config file add:* `--tag="config"`

## Usage
You can use either the `Harvest` Facade or resolve the `ApiManager` out of the ioc container.
```php
// resolve out of ioc container
$harvest = app()->make('harvest');
```

### Getting Data
Every Api call looks like this:
```php
$harvest->model_name->get();
Harvest::model_name()->get();
```

You can either grab the results with `get()` or `find($id)`
```php
// getting all clients
$harvest->clients->get();
Harvest::clients()->get();

// getting a client with id of 12345
$harvest->clients->find(12345);
Harvest::clients()->find(12345);

// getting all expenses
$harvest->expenses->get();
Harvest::expenses()->get();

// getting an expense with id of 12345
$harvest->expenses->find(12345);
Harvest::expenses()->find(12345);

//... you get the idea
```

There are some cases which have different methods, because they rely on other objects.
```php
// get all user_assignments with the project id of 12345
$harvest->userAssignments->fromProject(12345)->get()

// get an user_assignments with the id of 12345 which belongs to the project id of 4567
$harvest->userAssignments->fromProject(4567)->find(12345)

// get all estimate messages with the estimate id of 12345
$harvest->estimateMessages->fromEstimate(12345)->get();

// get an estimate messages with the id of 12345 which belongs to the estimate id of 4567
$harvest->estimateMessages->fromEstimate(4567)->find(12345)
```
List of exceptions:
- EstimateMessage
- InvoiceMessage
- InvoicePayment
- ProjectAssignment
- TaskAssignment
- UserAssignment

### Handling Responses
Api responses can be either converted into `json`, a `collection` or a `paginated collection` which is basically `json`
combined with `collection`.
```php
// receiving some response
$respose = Harvest::users()->get();

// convert result to json
$result->toJson();

// convert result to collection
$result->toCollection();

// convert result to paginated collection
$result->toPaginatedCollection();
```

### Handle Pagination
By default harvest gives back a JSON-response with up to 100 records. If you want to limit your results you should use 
`limit()`. If you want results from a specific page just pipe `fromPage()` before `find` or `get`.

```php
// get results from page 10
$harvest->projects()->page(10)->get()

// limit result entries to 50
$harvest->projects()->limit(50)->get();

// limit result entries and get results from page 10
$harvest->projects()->limit(50)->page(10)->get();
```

If your harvest entries exceeds 100 records and you just want to get the results from the next or previous page,
you may call `next()` on the result to get to the next 100 results. 

```php
// get next result page
$result = $result->next();

// get previous result page
$result = $result->previous();
```

### Additional Params
Adding additional params to your requests is also possible. *Not every param is supported yet*

*supported params:*
- `is_active` => `active()`

Some Api Calls allow you to have different params:
```php
    // get all invoices with a state of 'draft'
    $harvest->invoices()->state('draft')->get();
    
    // get all invoices with a client_id of '123445'
    $harvest->invoices()->client('123445')->get();
    
    // get all invoices with a project_id of '123445'
    $harvest->invoices()->project('123445')->get();
    
    // get all invoices which were updated since '2018-01-12'
    // => does also accept other formats like '12.01.2018'
    $harvest->invoices()->updatedSince('2018-01-12')->get();
    
    // get all invoices with an issue_date >= '2018-01-01'
    $harvest->invoices()->from('2018-01-01')->get();
    
    // get all invoices with an issue_date <= '2018-01-01'
    $harvest->invoices()->to('2018-01-01')->get();
```

### Loading External Relations
When you query the API for any object which has external relations, you might want to checkout the `loadExternal()`
method to get those relations loaded locally.

```php
// loading all external relations of one expense model
// by default if you have enabled `uses_database` in the config
// all external relations are saved to the database.
$expense->loadExternal();

// load all external relations without saving to db
$expense->loadExternal('*', false);

// load only user and client relations
$expense->loadExternal(['user', 'client']);
```

## ToDo
- update/create records
- improve tests

## Testing
Run the tests with:

``` bash
vendor/bin/phpunit
```

## Upgrading
Please see [UPGRADING](UPGRADING.md) for details.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security
If you discover any security-related issues, please email kkoenig@byte5.de instead of using the issue tracker.

## License
The MIT License (MIT). Please see [License File](/LICENSE.md) for more information.