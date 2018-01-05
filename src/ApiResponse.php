<?php

namespace Byte5\LaravelHarvest;

use Byte5\LaravelHarvest\Traits\CanConvertDateTimes;

class ApiResponse
{
    use CanConvertDateTimes;

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
     * @return \Illuminate\Support\Collection
     */
    public function toCollection()
    {
        if (! array_key_exists('total_entries', $this->jsonResult)) {
            return $this->transformToModel([$this->jsonResult]);
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
        $this->jsonResult[$this->getResultsKey()] = $this->toCollection();

        return $this->jsonResult;
    }

    /**
     * Go to next page of json result.
     *
     * @return ApiResponse
     */
    public function next()
    {
        if (! $this->hasNextPage()) {
            throw new \RuntimeException('The result does not have a next page!');
        }

        return new self(
            (new ApiGateway())->execute(array_get($this->jsonResult, 'links.next')),
            $this->model
        );
    }

    /**
     * Go to previous page of json result.
     *
     * @return ApiResponse
     */
    public function previous()
    {
        if (! $this->hasPreviousPage()) {
            throw new \RuntimeException('The result does not have a previous page!');
        }

        return new self(
            (new ApiGateway())->execute(array_get($this->jsonResult, 'links.previous')),
            $this->model
        );
    }

    public function hasNextPage()
    {
        return array_get($this->jsonResult, 'links.next') != null;
    }

    public function hasPreviousPage()
    {
        return array_get($this->jsonResult, 'links.previous') != null;
    }

    /**
     * @param $data
     * @return mixed
     */
    private function transformToModel($data)
    {
        return $this->convertDateTimes($data)->map(function ($data) {
            $transformerName = '\Byte5\LaravelHarvest\Transformer\\'.class_basename($this->model);

            return (new $transformerName)->transformModelAttributes($data);
        });
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
