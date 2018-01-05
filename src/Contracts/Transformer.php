<?php

namespace Byte5\LaravelHarvest\Contracts;

interface Transformer
{
    /**
     * @param $someModel
     * @return mixed
     */
    public function transformModelAttributes($someModel);
}
