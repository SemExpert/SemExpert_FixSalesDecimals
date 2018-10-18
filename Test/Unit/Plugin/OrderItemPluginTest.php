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
    protected $model;
    protected $objectManager;
    protected $orderFactory;
    protected $plugin;

    public function setUp()
    {
        $this->objectManager = new ObjectManager($this);
        $this->model = $this->objectManager->getObject(Item::class);
        $this->plugin = new OrderItemPlugin();
    }

    public function testSameValueOnIntegers()
    {
        $this->assertEquals(10, $this->plugin->afterGetQtyToInvoice($this->model, 10));
    }

    public function testSameValueOnFloat()
    {
        $this->assertEquals(10.12345678, $this->plugin->afterGetQtyToInvoice($this->model, 10.12345678));
    }

    public function testSameValueFloatRoundedUp()
    {
        $this->assertEquals(10.12345679, $this->plugin->afterGetQtyToInvoice($this->model, 10.12345678611));
    }

    public function testSameValueFloatRoundedDown()
    {
        $this->assertEquals(10.12345678, $this->plugin->afterGetQtyToInvoice($this->model, 10.12345678111));
    }
}
