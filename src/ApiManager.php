<?php

namespace Byte5\LaravelHarvest;

use Byte5\LaravelHarvest\Traits\CanResolveEndpoints;

class ApiManager
{
    use CanResolveEndpoints;

    /**
     * @var
     */
    protected $endpoint;

    /**
     * @var ApiGateway
     */
    protected $gateway;

    /**
     * ApiManager constructor.
     * @param ApiGateway $gateway
     */
    public function __construct(ApiGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param $name
     */
    protected function setEndpoint($name)
    {
        $this->endpoint = $this->resolveEndpoint($name);
    }

    /**
     * @param $name
     * @return $this
     */
    public function __get($name)
    {
        $this->setEndpoint($name);

        return $this;
    }

    /**
     * @param $name
     * @param $arguments
     * @return ApiManager|ApiResponse
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

        return tap($this->craftResponse($url), function () {
            $this->clearEndpoint();
        });
    }

    /**
     * Sets current endpoint to null.
     */
    protected function clearEndpoint()
    {
        $this->endpoint = null;
    }

    /**
     * Crafts ApiResponse.
     *
     * @param $url
     * @return ApiResponse
     */
    protected function craftResponse($url)
    {
        return new ApiResponse($this->gateway->execute($url), $this->endpoint->getModel());
    }

    /**
     * @return bool
     */
    protected function isStaticCall()
    {
        return ! $this->endpoint;
    }
}
