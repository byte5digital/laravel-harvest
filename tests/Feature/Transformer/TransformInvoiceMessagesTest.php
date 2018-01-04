<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Models\InvoiceMessage;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformInvoiceMessagesTest extends TestCase
{
    /** @test **/
    function it_can_transform_invoice_messages_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, InvoiceMessage::class))->toCollection();;

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof InvoiceMessage);
    }

    /** @test **/
    function it_can_transform_invoice_messages_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, InvoiceMessage::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['invoice_messages'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'invoice_messages' => [
                [
                    'id' => 27835209,
                    'sent_by' => 'Bob Powell',
                    'sent_by_email' => 'bobpowell@example.com',
                    'sent_from' => 'Bob Powell',
                    'sent_from_email' => 'bobpowell@example.com',
                    'include_link_to_client_invoice' => false,
                    'send_me_a_copy' => false,
                    'thank_you' => false,
                    'reminder' => false,
                    'send_reminder_on' => NULL,
                    'created_at' => '2017-08-23T22:15:06Z',
                    'updated_at' => '2017-08-23T22:15:06Z',
                    'attach_pdf' => true,
                    'event_type' => NULL,
                    'recipients' => [
                        [
                            'name' => 'Richard Roe',
                            'email' => 'richardroe@example.com',
                        ]
                    ],
                    'subject' => 'Past due invoice reminder: #1001 from API Examples',
                    'body' => 'Dear Customer,

                                This is a friendly reminder to let you know that Invoice 1001 is 144 days past due. If you have already sent the payment, please disregard this message. If not, we would appreciate your prompt attention to this matter.
                                
                                Thank you for your business.
                                
                                Cheers,
                                API Examples',
                ],
                [
                    'id' => 27835207,
                    'sent_by' => 'Bob Powell',
                    'sent_by_email' => 'bobpowell@example.com',
                    'sent_from' => 'Bob Powell',
                    'sent_from_email' => 'bobpowell@example.com',
                    'include_link_to_client_invoice' => false,
                    'send_me_a_copy' => true,
                    'thank_you' => false,
                    'reminder' => false,
                    'send_reminder_on' => NULL,
                    'created_at' => '2017-08-23T22:14:49Z',
                    'updated_at' => '2017-08-23T22:14:49Z',
                    'attach_pdf' => true,
                    'event_type' => NULL,
                    'recipients' => [
                        [
                            'name' => 'Richard Roe',
                            'email' => 'richardroe@example.com',
                        ],
                        [
                            'name' => 'Bob Powell',
                            'email' => 'bobpowell@example.com',
                        ]
                    ],
                    'subject' => 'Invoice #1001 from API Examples',
                    'body' => '---------------------------------------------
                                Invoice Summary
                                ---------------------------------------------
                                Invoice ID: 1001
                                Issue Date: 04/01/2017
                                Client: 123 Industries
                                P.O. Number: 
                                Amount: €288.90
                                Due: 04/01/2017 (upon receipt)
                                
                                The detailed invoice is attached as a PDF.
                                
                                Thank you!
                                ---------------------------------------------',
                ],
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 2,
            'next_page' => NULL,
            'previous_page' => NULL,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/api/v2/invoices/13150403/messages?page=1&per_page=100',
                'next' => NULL,
                'previous' => NULL,
                'last' => 'https://api.harvestapp.com/v2/invoices/13150403/messages?page=1&per_page=100',
            ],
        ];
    }
}