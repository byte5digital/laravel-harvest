# Upgrading
If you have difficulties upgrading, please create an issue.

## From v2.1 to v2.2
If you save `invoices` to your app you should add a migration with:
```php
    $tableName = config('harvest.table_prefix').config('harvest.table_names.invoices');
    
    Schema::create($tableName, function (Blueprint $table) {
        $table->string('state');
    });
```

## From v1 to v2
Because v2 is a complete rewrite a simple upgrade path is not available.
If you want to upgrade completely remove the v1 package and follow install instructions of v2.