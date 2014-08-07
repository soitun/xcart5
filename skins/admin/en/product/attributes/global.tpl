{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * "Global Attributes" tab
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget class="XLite\View\Product\Details\Admin\ProductClass" />

<widget class="XLite\View\Form\Product\Modify\Attributes" name="update_attributes_form" className="attrs" />
  {if:product.productClass}
  <div class="dialog-block attribute-classes">
    <widget class="XLite\View\Product\Details\Admin\Attributes" productClass="{product.productClass}" />
  </div>
  {end:}
  <div class="dialog-block">
    <widget class="XLite\View\Product\Details\Admin\Attributes" />
  </div>
  <widget class="\XLite\View\StickyPanel\Product\Attributes" />
<widget name="update_attributes_form" end />

<widget class="XLite\View\Product\Details\Admin\CreateBox" />
