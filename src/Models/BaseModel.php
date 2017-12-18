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
            if (! $this->{$key} ||  $this->{$key}['id'] == null) {
                unset($this->{$key});
                return;
            }

            if ($value === 'extern') {
                $this->{$key.'_id'} = $this->{$key}['id'];
                unset($this->{$key});
            }

            if ($value === 'relation' || array_get($value, 'type') === 'relation') {
                $relationMethod = camel_case($key);
                $relationClass = is_array($value) ? array_get($value, 'class') : $relationMethod;
                if (! $this->$relationMethod()->exists()) {
                    $baseKey = is_array($value) && array_has($value, 'baseKey') ? $value['baseKey'] : '';

                    call_user_func('\Harvest::get'.ucfirst($relationClass).'ById', $this->{$key}['id'], array_get($this, $baseKey))
                        ->toCollection()->first()->save();
                }

                $relationClassName = '\Naoray\LaravelHarvest\Models\\'.ucfirst($relationClass);
                $this->{$key.'_id'} = (new $relationClassName())->whereExternalId($this->{$key}['id'])->first()->id;
                unset($this->{$key});
            }
        });
    }
}