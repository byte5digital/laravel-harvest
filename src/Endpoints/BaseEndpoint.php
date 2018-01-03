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
     * @return mixed
     */
    public function get()
    {
        $this->buildUrl();

        return $this->getUrl();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $this->buildUrl('/'.$id);

        return $this->getUrl();
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
     * Get endpoint url.
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
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