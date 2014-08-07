{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Search results template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<dl>
  {foreach:getProducts(),product}
    <dt>
      <a href="{buildURL(#product#,##,_ARRAY_(#product_id#^product.product_id))}">{product.getName():h}</a>
    </dt>

    <dd>
      <widget class="\XLite\Module\CDev\InstantSearch\View\Product" productId="{product.getProductId()}" />
    </dd>
  {end:}
</dl>
