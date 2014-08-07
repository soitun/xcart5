{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Average rating value
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<widget
  class="\XLite\Module\XC\Reviews\View\Form\AverageRating"
  name="rate-product"
  product_id="{product.product_id}"
  target_widget="\\XLite\\Module\\XC\\Reviews\\View\\Customer\\ReviewsPage\\AverageRating" />
  <div class="product-average-rating">
    <list name="reviews.page.rating" />
  </div>
<widget name="rate-product" end />
