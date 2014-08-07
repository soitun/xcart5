{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Pin codes list body 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div IF="hasResults()" class="account-pin-codes">
  <widget FOREACH="getPageData(),order" class="\XLite\Module\CDev\PINCodes\View\AccountOrderPinCodes" order="{order}" />
</div>
<div IF="!hasResults()">{t(#No pin codes are bought yet#)}</div>
