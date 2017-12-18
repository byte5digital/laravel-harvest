<?php

namespace Naoray\LaravelHarvest;

use Naoray\LaravelHarvest\Traits\CanGuessEndpointNames;

class ApiManager
{
    use CanGuessEndpointNames;

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
    private function setEndpoint($name)
    {
        $endpointClass = 'Naoray\LaravelHarvest\Endpoints\\'.$this->guessEndpointName($name);

        if (! class_exists($endpointClass)) {
            throw new \RuntimeException("Endpoint $name does not exist!");
        }

        $this->endpoint = new $endpointClass;
    }

    /**
     * @param $name
     * @return $this
     */
    public function __get($name)
    {
        $this->setEndpoint(ucfirst($name));

        return $this;
    }

    /**
     * @param $name
     * @param $arguments
     * @return ApiResult
     */
    public function __call($name, $arguments)
    {
        $apiCall = null;

        if ($this->isStaticCall()) {
            $this->setEndpoint(str_after($name, 'get'));
            $apiCall = $this->guessApiCall($name);

        } else if (! method_exists($this->endpoint, $name)) {
            throw new \RuntimeException("Endpoint method $name does not exist!");
        }

        $url = ! $apiCall
            ? call_user_func_array( array($this->endpoint, $name), $arguments)
            : call_user_func_array( array($this->endpoint, $apiCall), $arguments);

        $endpoint = $this->endpoint;
        $this->endpoint = null;

        return new ApiResult(
            $this->gateway->execute($url),
            $endpoint->getModel()
        );
    }

    /**
     * @param $name
     * @return mixed
     */
    private function guessApiCall($name)
    {
        return str_contains($name, 'Id') ? 'id'
            : (str_contains($name, 'Current') ? 'me' : 'all');
    }

    /**
     * @return bool
     */
    private function isStaticCall()
    {
        return ! $this->endpoint;
    }
}