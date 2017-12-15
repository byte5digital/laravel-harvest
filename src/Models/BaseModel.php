<?php

namespace Naoray\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    /**
     * @var array
     */
    protected $transformable = [];

    /**
     * @var Transformer
     */
    protected $transformer;

    /**
     * BaseModel constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * Call eloquent's save method after transforming model attributes.
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        $this->transformModelRelations();

        return parent::save($options);
    }

    /**
     * Transform transformable model attributes.
     */
    private function transformModelRelations()
    {
        collect($this->transformable)->each(function ($value, $key) {
            if ($value === 'relation') {
                $relationMethod = camel_case($key);

                if (! $this->$relationMethod()->exists()) {
                    call_user_func('\Harvest::get'.ucfirst($relationMethod).'ById', $this->{$key}['id'])
                        ->toCollection()->first()->save();
                }

                $relationClassName = '\Naoray\LaravelHarvest\Models\\'.ucfirst($relationMethod);
                $this->{$key.'_id'} = (new $relationClassName())->whereExternalId($this->{$key}['id'])->first()->id;
                unset($this->{$key});
            }
        });
    }
}