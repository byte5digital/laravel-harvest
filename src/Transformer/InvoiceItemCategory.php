<?php

namespace Naoray\LaravelHarvest\Transformer;

use Naoray\LaravelHarvest\Contracts\Transformer;
use \Naoray\LaravelHarvest\Models\InvoiceItemCategory as InvoiceItemCategoryModel;

class InvoiceItemCategory implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $invoiceItemCat = (new InvoiceItemCategoryModel())->firstOrNew(['external_id' => $data['id']]);

        $invoiceItemCat->external_id = $data['id'];
        $invoiceItemCat->name = $data['name'];
        $invoiceItemCat->use_as_expense = $data['use_as_expense'];
        $invoiceItemCat->use_as_service = $data['use_as_service'];

        return $invoiceItemCat;
    }
}