<?php

namespace Byte5\LaravelHarvest\Test\Fakes;

use Byte5\LaravelHarvest\ApiManager;

class FakeApiManager extends ApiManager
{
    protected $beforeCraftingResponseCallback;

    /**
     * @return mixed
     */
    public function getRequestUrl()
    {
        return $this->endpoint->getUrl();
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param $callback
     */
    public function beforeCraftingResponse($callback)
    {
        $this->beforeCraftingResponseCallback = $callback;
    }

    /**
     * @param $name
     * @param $arguments
     * @return FakeApiManager|ApiResponse
     * @override
     */
    public function __call($name, $arguments)
    {
        $apiCall = null;

        if ($this->isStaticCall() && ! $this->endpoint) {
            $this->setEndpoint($name);

            return $this;
        }

        if (! method_exists($this->endpoint, $name)) {
            throw new \RuntimeException("Endpoint method $name does not exist!");
        }

        $url = call_user_func_array([$this->endpoint, $name], $arguments);

        if ($url == null) {
            return $this;
        }

        if ($this->beforeCraftingResponseCallback != null) {
            $callback = $this->beforeCraftingResponseCallback;
            $this->beforeCraftingResponseCallback = null;
            $callback();
        }

        return tap($this->craftResponse($url), function () {
            $this->clearEndpoint();
        });
    }
}
