<?php
/**
 * Created by PhpStorm.
 * User: Barbazul
 * Date: 17/9/2018
 * Time: 7:20 PM
 */

namespace SemExpert\FixSalesDecimals\Plugin;

use Magento\Sales\Model\Order\Item;

class OrderItemPlugin
{
    public function afterGetSimpleQtyToShip(Item $subject, $result)
    {

    }

    public function afterGetQtyToInvoice(Item $subject, $result)
    {

    }
}
