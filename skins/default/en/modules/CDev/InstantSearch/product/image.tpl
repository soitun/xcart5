{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product view template - image part
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="instant-search.product", weight="10")
 *}

<div class="product-image">
  <a href="{buildURL(#product#,##,_ARRAY_(#product_id#^product.getProductId()))}"><widget class="\XLite\View\Image" image="{product.getImage()}" className="photo product-thumbnail" maxWidth="{getImageMaxWidth()}" maxHeight="{getImageMaxHeight()}" centerImage /></a>
</div>
