<?php
/**
 * Created by PhpStorm.
 * User: Barbazul
 * Date: 17/9/2018
 * Time: 7:20 PM
 *
 * This plugin implements the Official Magento Fix for decimal handling in order quantities for magento 2.3.x
 * More information on https://github.com/magento/magento2/pull/1434
 */

namespace SemExpert\FixSalesDecimals\Plugin;

use Magento\Sales\Model\Order\Item;

class OrderItemPlugin
{
    /**
     * Fix for correct qty decimal number round.
     *
     * @return float|integer
     */
    public function afterGetSimpleQtyToShip(Item $subject, $result)
    {
        return round($result, 8);
    }

    /**
     * Fix for correct qty decimal number round.
     *
     * @return float|integer
     */
    public function afterGetQtyToInvoice(Item $subject, $result)
    {
        return round($result, 8);
    }
}
