{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Address book
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<ul class="address-book clearfix">

  <widget FOREACH="getAddresses(),address" class="\XLite\View\Address" displayMode="text" displayWrapper="1" address="{address}" />

  <widget class="\XLite\View\Address" displayMode="text" displayWrapper="1" />

</ul>
