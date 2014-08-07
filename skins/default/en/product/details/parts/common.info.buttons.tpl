{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product details buttons block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.details.page.info", weight="100")
 * @ListChild (list="product.details.quicklook.info", weight="100")
 *}

<div class="product-buttons shade-base">
  {if:isProductAdded()}
    <list name="buttons-added" type="nested" />
  {else:}
    <list name="buttons" type="nested" />
  {end:}
</div>
