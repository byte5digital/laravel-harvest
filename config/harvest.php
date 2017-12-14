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