<?php

namespace Byte5\LaravelHarvest\Traits;

trait HasExternalRelations
{
    /**
     * Loads relations from harvest api external relationships.
     *
     * @param  array|string  $relations
     * @return $this
     */
    public function loadExternal($relations)
    {
        // normalize input
        if (is_string($relations)) {
            $relations = func_get_args();
        }

        // map relation to relation key
        collect($relations)->filter(function ($relation) {
            return ! $this->{$relation} || $this->{$relation.'_id'} != null ||
                in_array($relation, $this->externalRelations) || array_has($this->externalRelations, $relation);

        })->each(function ($relation) {
            $relationId = $this->{$relation}['id'];
            $relationKey = in_array($relation, $this->externalRelations)
                ? $relation : $this->externalRelations[$relation];

            $request = call_user_func('Harvest::'.$relationKey);

            // convert into model
            // add relation to model
            $this->{$relationKey} = $request->find($relationId)->toCollection()->first();
        });

        return $this;
    }

    /**
     * Transform transformable model attributes.
     */
    private function transformModelRelations()
    {
        collect($this->transformable)->each(function ($value, $key) {
            // Unset key if no Id is provided
            if (! $this->{$key} ||  $this->{$key}['id'] == null) {
                unset($this->{$key});

                return;
            }

            // if relation equals extern just set the id and unset extern var
            if ($value === 'extern') {
                $this->{$key.'_id'} = $this->{$key}['id'];

                unset($this->{$key});
            }

            // If type is relation get key id and check if record already exists in db
            // if record does not exist try to get the record from harvest api and save it to the db
            if ($value === 'relation' || array_get($value, 'type') === 'relation') {
                $relationMethod = camel_case($key);
                $relationClass = is_array($value) ? array_get($value, 'class') : $relationMethod;

                $relationClassName = '\Byte5\LaravelHarvest\Models\\'.ucfirst($relationClass);
                $this->{$key.'_id'} = optional((new $relationClassName())->whereExternalId($this->{$key}['id'])->first())->id;

                if (! $this->$relationMethod()->exists()) {
                    $baseKey = is_array($value) && array_has($value, 'baseKey') ? $value['baseKey'] : '';

                    call_user_func('\Harvest::get'.ucfirst($relationClass).'ById', $this->{$key}['id'], array_get($this, $baseKey))
                        ->toCollection()->first()->save();
                    $this->{$key.'_id'} = (new $relationClassName())->whereExternalId($this->{$key}['id'])->first()->id;
                }

                unset($this->{$key});
            }
        });
    }
}