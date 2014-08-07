{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Variants
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget class="XLite\Module\XC\ProductVariants\View\Form\Product\Modify\Variants" name="update_variants_form" className="form-variants" />
  <div class="{getBlockStyle()}">
    <div class="header clearfix">
      <span class="title">{getTitle()}</span>
      <widget IF="isAllowVaraintAdd()" template="modules/XC/ProductVariants/variants/parts/create_variants.tpl" />
    </div>
    <div class="content">
      <widget class="XLite\Module\XC\ProductVariants\View\ItemsList\Model\ProductVariant" />
    </div>
  </div>
  <widget class="XLite\Module\XC\ProductVariants\View\StickyPanel\ItemsList\ProductVariant" />
<widget name="update_variants_form" end />
