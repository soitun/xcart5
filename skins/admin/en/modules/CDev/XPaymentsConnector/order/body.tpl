{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * iframe 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="order.operations", weight="290")
 *}

<br/><br/>

<div IF="getXpcTransactions()">
  <widget class="XLite\Module\CDev\XPaymentsConnector\View\ItemsList\Model\Order\SavedCards" />
</div>

<br/>
