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
    protected $limit;

    /**
     * @var
     */
    protected $url;

    /**
     * @var
     */
    protected $page;

    /**
     * @return mixed
     */
    abstract protected function getPath();

    /**
     * @return mixed
     */
    abstract public function getModel();

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

        $fullPath = $this->apiV2Url.$path.$subPath;
        $params = $this->getUrlParams();

        $this->url = $fullPath.$params;
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
     * @return string
     */
    public function getUrlParams()
    {
        $page = $this->page;
        $limit = $this->limit;
        $seperator = '&';
        $params = '';

        $params .= $page;

        if (! $page) {
            $seperator = '?';
        }

        $params .= $limit ? $seperator.$limit : '';

        return $params;
    }

    /**
     * @param $page
     */
    public function page($page)
    {
        $this->page = '?page='.$page;
    }

    /**
     * @param $limit
     */
    public function limit($limit)
    {
        $this->limit = 'per_page='.$limit;
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
