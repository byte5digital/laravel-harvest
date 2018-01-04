<?php

return [
    /*
     * Api Key used for authenticating at Harvest API
     */
    'api_key' => env('HARVEST_API_KEY', ''),

    /*
     * Account Id of the company you want to integrate the api for.
     */
    'account_id' => env('HARVEST_ACCOUNT_ID', ''),

    /*
     * This option determines if the database is checked for existing
     * record of the received data from the harvest api. If this
     * option is set to true, every time you query data from
     * the Harvest API and transform it into a collection
     * the database is checked if this record already
     * exists in your local database.
     *
     * If you set this option to true, don't forget to publish and
     * migrate the migration tables!
     */
    'uses_database' => false,

    /*
     * Prefix used for all tables of this package. If you change
     * the prefix, don't forget to migrate afterwards.
     */
    'table_prefix' => 'harvest_',

    /*
     * All table names of this package. If you change a name
     * of any table, don't forget to migrate afterwards.
     */
    'table_names' => [
        'clients' => 'clients',
        'companies' => 'companies',
        'contacts' => 'contacts',
        'estimates' => 'estimates',
        'estimate_item_categories' => 'estimate_item_categories',
        'estimate_messages' => 'estimate_messages',
        'expenses' => 'expenses',
        'expense_categories' => 'expense_categories',
        'invoices' => 'invoices',
        'invoice_item_categories' => 'invoice_item_categories',
        'invoice_messages' => 'invoice_messages',
        'invoice_payments' => 'invoice_payments',
        'projects' => 'projects',
        'project_assignments' => 'project_assignments',
        'roles' => 'roles',
        'tasks' => 'tasks',
        'task_assignments' => 'task_assignments',
        'time_entries' => 'time_entries',
        'users' => 'users',
        'user_assignments' => 'user_assignments',
    ]
];