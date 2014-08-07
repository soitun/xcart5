{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Add to bag buttons
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="add-button-wrapper {getFingerprint()}">
  <widget IF="!isOutOfStock()" class="\XLite\View\Button\Submit" label="Add to cart" style="regular-main-button add2cart" />
</div>
