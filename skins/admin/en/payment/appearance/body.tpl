{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Payment methods. Appearance tab.
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
 <div class="payment-appearance-description">
{t(#Payment methods appearance description#):h}
 </div>
<widget class="XLite\View\Form\ItemsList\Payment\Main" name="list" />
  <widget class="\XLite\View\ItemsList\Model\Payment\Methods" />
<widget name="list" end />