<?php
/**
 * Created by PhpStorm.
 * User: Barbazul
 * Date: 12/9/2018
 * Time: 3:25 PM
 */

namespace SemExpert\FixSalesDecimals\Test\Unit\Plugin;

use PHPUnit\Framework\TestCase;
use SemExpert\FixSalesDecimals\Plugin\OrderItemPlugin;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Sales\Model\Order\Item;

class OrderItemPluginTest extends TestCase
{
    public function testSameValueOnIntegers()
    {
        $plugin = new OrderItemPlugin();
        $objectManager = new ObjectManager($this);
        $model = $objectManager->getObject(Item::class);
        $this->assertEquals(10, $plugin->afterGetQtyToInvoice($model, 10));
    }
}
