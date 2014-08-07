{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Promo block content for chackout page
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div IF="hasNextDiscount()" class="volume-discounts-promo">

  <div class="banner">
    <div class="banner-box">-{getNextDiscountValue()}</div>
  </div>

  <span class="next">{t(#Get X off for order amount over Y#,_ARRAY_(#X#^getNextDiscountValue(),#Y#^getNextDiscountSubtotal()))}</span>

</div>
