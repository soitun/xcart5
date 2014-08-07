{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Rating value in product info
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<widget
  class="\XLite\Module\XC\Reviews\View\Form\AverageRating"
  name="rate-product"
  product_id="{getRatedProductId()}"
  target_widget="\\XLite\\Module\\XC\\Reviews\\View\\Customer\\ProductInfo\\ItemsList\\AverageRating" />

  <list name="reviews.product.rating.average" product="{getRatedProduct()}" />

<widget name="rate-product" end />
