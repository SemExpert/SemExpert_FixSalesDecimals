<?php

namespace SemExpert\FixSalesDecimals\Test\Integration\Model\Order;

use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Sales\Model\Order\Item;
use Magento\Sales\Model\OrderFactory;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    /**
     * Test different combinations of item qty setups
     *
     * @param array $options
     * @param float $expectedResult
     *
     * @dataProvider getItemQtyVariants
     */
    public function testGetSimpleQtyToMethods(array $options, $expectedResult)
    {
        $objectManager = new ObjectManager($this);

        $arguments = [
            'orderFactory' => $this->createPartialMock(OrderFactory::class, ['create']),
            'serializer' => $this->getMockBuilder(Json::class)->setMethods(['unserialize'])->getMock()
        ];

        $model = $objectManager->getObject(Item::class, $arguments);
        $model->setData($options);

        $this->assertSame($model->getSimpleQtyToShip(), $expectedResult['to_ship']);
        $this->assertSame($model->getQtyToInvoice(), $expectedResult['to_invoice']);
    }

    /**
     * Provides different combinations of qty options for an item and the
     * expected qtys pending shipment and invoice
     *
     * @return array
     */
    public function getItemQtyVariants()
    {
        return [
            'empty_item' => [
                'options' => [
                    'qty_ordered' => 0, 'qty_invoiced' => 0, 'qty_refunded' => 0, 'qty_shipped' => 0,
                    'qty_canceled' => 0
                ],
                'expectedResult' => ['to_ship' => 0.0, 'to_invoice' => 0.0]
            ],
            'ordered_item' => [
                'options' => [
                    'qty_ordered' => 12, 'qty_invoiced' => 0, 'qty_refunded' => 0, 'qty_shipped' => 0,
                    'qty_canceled' => 0
                ],
                'expectedResult' => ['to_ship' => 12.0, 'to_invoice' => 12.0]
            ],
            'partially_invoiced' => [
                'options' => [
                    'qty_ordered' => 12, 'qty_invoiced' => 4, 'qty_refunded' => 0, 'qty_shipped' => 0,
                    'qty_canceled' => 0
                ],
                'expectedResult' => ['to_ship' => 12.0, 'to_invoice' => 8.0]
            ],
            'completely_invoiced' => [
                'options' => [
                    'qty_ordered' => 12, 'qty_invoiced' => 12, 'qty_refunded' => 0, 'qty_shipped' => 0,
                    'qty_canceled' => 0,
                ],
                'expectedResult' => ['to_ship' => 12.0, 'to_invoice' => 0.0]
            ],
            'partially_invoiced_refunded' => [
                'options' => [
                    'qty_ordered' => 12, 'qty_invoiced' => 5, 'qty_refunded' => 5, 'qty_shipped' => 0,
                    'qty_canceled' => 0,
                ],
                'expectedResult' => ['to_ship' => 7.0, 'to_invoice' => 7.0]
            ],
            'partially_refunded' => [
                'options' => [
                    'qty_ordered' => 12, 'qty_invoiced' => 12, 'qty_refunded' => 5, 'qty_shipped' => 0,
                    'qty_canceled' => 0,
                ],
                'expectedResult' => ['to_ship' => 7.0, 'to_invoice' => 0.0]
            ],
            'partially_shipped' => [
                'options' => [
                    'qty_ordered' => 12, 'qty_invoiced' => 0, 'qty_refunded' => 0, 'qty_shipped' => 4,
                    'qty_canceled' => 0
                ],
                'expectedResult' => ['to_ship' => 8.0, 'to_invoice' => 12.0]
            ],
            'partially_refunded_partially_shipped' => [
                'options' => [
                    'qty_ordered' => 12, 'qty_invoiced' => 12, 'qty_refunded' => 5, 'qty_shipped' => 4,
                    'qty_canceled' => 0
                ],
                'expectedResult' => ['to_ship' => 3.0, 'to_invoice' => 0.0]
            ],
            'complete' => [
                'options' => [
                    'qty_ordered' => 12, 'qty_invoiced' => 12, 'qty_refunded' => 0, 'qty_shipped' => 12,
                    'qty_canceled' => 0
                ],
                'expectedResult' => ['to_ship' => 0.0, 'to_invoice' => 0.0]
            ],
            'canceled' => [
                'options' => [
                    'qty_ordered' => 12, 'qty_invoiced' => 0, 'qty_refunded' => 0, 'qty_shipped' => 0,
                    'qty_canceled' => 12
                ],
                'expectedResult' => ['to_ship' => 0.0, 'to_invoice' => 0.0]
            ],
            'completely_shipped_using_decimals' => [
                'options' => [
                    'qty_ordered' => 4.4, 'qty_invoiced' => 0.4, 'qty_refunded' => 0.4, 'qty_shipped' => 4,
                    'qty_canceled' => 0,
                ],
                'expectedResult' => ['to_ship' => 0.0, 'to_invoice' => 4.0]
            ],
            'completely_invoiced_using_decimals' => [
                'options' => [
                    'qty_ordered' => 4.4, 'qty_invoiced' => 4, 'qty_refunded' => 0, 'qty_shipped' => 4,
                    'qty_canceled' => 0.4
                ],
                'expectedResult' => ['to_ship' => 0.0, 'to_invoice' => 0.0]
            ]
        ];
    }
}
