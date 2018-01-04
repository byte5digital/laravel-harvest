<?php

namespace Byte5\LaravelHarvest\Traits;

use Illuminate\Support\Collection;

trait HasExternalRelations
{
    /**
     * Loads relations from harvest api external relationships.
     *
     * @param  array|string  $relations
     * @return $this
     */
    public function loadExternal($relations = '*')
    {
        // normalize input
        if ($relations == '*') {
            $relations = $this->externalRelations;
        }

        if (is_string($relations)) {
            $relations = func_get_args();
        }

        $relations = $this->filterRelations($relations);

        $this->mapRelations($relations);

        return $this;
    }

    /**
     * Only return relevant relations.
     *
     * @param $relations
     * @return static
     */
    private function filterRelations($relations)
    {
        return collect($relations)->filter(function ($relation) {
            return $this->relationExists($relation)
                || $this->relationHasNotBeenEstablished($relation);
        });
    }

    /**
     * Checks if the relation does exist in the external relations array.
     *
     * @param $relation
     * @return bool
     */
    private function relationExists($relation)
    {
        return in_array($relation, $this->externalRelations) || array_has($this->externalRelations, $relation);
    }

    /**
     * Checks if the relation has already been established.
     *
     * @param $relation
     * @return bool
     */
    private function relationHasNotBeenEstablished($relation)
    {
        return ! $this->{$relation} || $this->{$relation.'_id'} != null;
    }

    /**
     * Maps given relations with their models.
     *
     * @param $relations
     * @return Collection
     */
    private function mapRelations($relations)
    {
        return $relations->each(function ($relation) {
            $relationId = $this->{'external_'.$relation.'_id'};
            $relationKey = $this->getRelationKey($relation);

            $relationModel = call_user_func('Harvest::'.$relationKey)
                                ->find($relationId)
                                ->toCollection()
                                ->first();

            $this->$relationKey()->associate($relationModel);
        });
    }

    /**
     * Returns the key of the passed in relation.
     *
     * @param $relation
     * @return String
     */
    private function getRelationKey($relation)
    {
        return in_array($relation, $this->externalRelations)
            ? $relation : $this->externalRelations[$relation];
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