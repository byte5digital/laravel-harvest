<?php

namespace Byte5\LaravelHarvest\Endpoints;

abstract class BaseEndpoint
{
    /**
     * @var string
     */
    protected $apiV2Url = 'https://api.harvestapp.com/v2/';

    /**
     * @var
     */
    protected $baseId;

    /**
     * @var
     */
    protected $url;

    /**
     * @return mixed
     */
    protected abstract function getPath();

    /**
     * @return mixed
     */
    public abstract function getModel();

    /**
     * @param string $id
     * @return mixed
     */
    public function all($id = '')
    {
        $this->baseId = $id;

        $this->buildUrl();

        return $this->get();
    }

    /**
     * @return mixed
     */
    protected function get()
    {
        return $this->url;
    }

    /**
     * @param $id
     * @param $baseId
     * @return mixed
     */
    public function id($id, $baseId = '')
    {
        $this->baseId = $baseId;

        $this->buildUrl('/'.$id);

        return $this->get();
    }

    /**
     * @param $subPath
     * @return string
     */
    protected function buildUrl($subPath = '')
    {
        $path = $this->replaceVarsInPath();

        $this->url = $this->apiV2Url.$path.$subPath;
    }

    /**
     * @return mixed|null|string|string[]
     */
    private function replaceVarsInPath()
    {
        $tmpPath = $this->getPath();

        if (! $this->baseId || ! str_contains($tmpPath, '{')) {
            return $tmpPath;
        }

        return preg_replace('/\{.*\}/', $this->baseId, $tmpPath);
    }
}