<?php

namespace Byte5\LaravelHarvest\Models;

class Expense extends BaseModel
{
    /**
     * @var array
     */
    protected $casts = [
        'receipt' => 'object',
        'billable' => 'boolean',
        'is_closed' => 'boolean',
        'is_locked' => 'boolean',
        'is_billed' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'spent_date'];

    /**
     * @var array
     */
    protected $fillable = [
        'external_id', 'client_id', 'project_id', 'expense_category_id', 'user_id',
        'invoice_id', 'receipt', 'notes', 'billable', 'is_closed',
        'is_locked', 'is_billed', 'locked_reason', 'spent_date',
    ];

    /**
     * @var array
     */
    protected $transformable = [
        'client' => 'relation',
        'project' => 'relation',
        'expense_category' => 'relation',
        'user' => 'relation',
        'user_assignment' => 'relation',
        'invoice' => 'relation',
    ];

    /**
     * Expense constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.expenses')
        );
    }

    /**
     * @return mixed
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return mixed
     */
    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }

    /**
     * @return mixed
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * @return mixed
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return mixed
     */
    public function userAssignment()
    {
        return $this->belongsTo(UserAssignment::class);
    }
}