<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'external_id', 'currency', 'name', 'is_active', 'address',
    ];

    /**
     * Client constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.clients')
        );
    }

    /**
     * Get client's contacts.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Get client's expenses.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Get client's invoices.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get client's project.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get client's time entries.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timeEntries()
    {
        return $this->hasMany(TimeEntry::class);
    }
}
