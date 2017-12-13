<?php

namespace Naoray\LaravelHarvest;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ApiResult
{
    /**
     * @var
     */
    protected $data;

    /**
     * @var
     */
    protected $jsonResult;

    /**
     * @var Model
     */
    protected $model;

    /**
     * ApiResult constructor.
     * @param $data
     * @param $modelName
     */
    public function __construct($data, $modelName)
    {
        $this->data = $data;
        $this->jsonResult = $this->data->json();
        $this->model = $modelName;
    }

    /**
     * Transform results to json.
     *
     * @return mixed
     */
    public function toJson()
    {
        return $this->jsonResult;
    }

    /**
     * Transforms results into collection.
     * 
     * @return [type] [description]
     */
    public function toCollection()
    {
        if ($this->countResults() == 1) {
            return $this->transformToModel([$this->jsonResult])->first();
        }

        return $this->transformToModel($this->jsonResult[$this->getResultsKey()]);
    }

    /**
     * Transform results to collection.
     *
     * @return mixed
     */
    public function toPaginatedCollection()
    {
        if ($this->countResults() == 1) {
            return $this->transformToModel([$this->jsonResult])->first();
        }

        $key = $this->getResultsKey();
        $this->jsonResult[$key] = $this->transformToModel($this->jsonResult[$key]);

        return $this->jsonResult;
    }

    /**
     * @return int
     */
    private function countResults()
    {
        if (array_key_exists('total_entries', $this->jsonResult)) {
            return $this->jsonResult['total_entries'];
        }

        return 1;
    }

    /**
     * @param $data
     * @return mixed
     */
    private function transformToModel($data)
    {
        $data = collect($data)->map(function ($item) {
            $item['created_at'] = Carbon::parse($item['created_at']);
            $item['updated_at'] = Carbon::parse($item['updated_at']);

            return $item;
        });


        return call_user_func($this->model.'::hydrate', $data->toArray());
    }

    /**
     * Get results key.
     */
    private function getResultsKey()
    {
        return snake_case(
            str_plural(
                class_basename($this->model)
            )
        );
    }
}