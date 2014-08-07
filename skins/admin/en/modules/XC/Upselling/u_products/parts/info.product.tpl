{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product link
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<a
  href="{buildURL(#product#,##,_ARRAY_(#product_id#^entity.product.getId(),#page#^#upselling_products#))}"
  title="{entity.product.getName()}"
  class="uproduct-name product-name">
  {entity.product.getName()}</a>
<img src="images/spacer.gif" class="right-fade" alt="" />
