<?php

namespace Naoray\LaravelHarvest\Contracts;

interface Transformer
{
    /**
     * @param $someModel
     * @return mixed
     */
    public function transformModelAttributes($someModel);
}