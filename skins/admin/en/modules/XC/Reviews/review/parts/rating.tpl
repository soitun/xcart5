{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Rating
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="review.modify.fields", weight="200")
 *}
<li class="input rating clearfix">
  <div class="table-label">
    <label for="rating" class="rating">{t(#Rating#)}</label>
  </div>

  <div class="star">&nbsp;</div>
  <div class="table-value">
    <widget
      class="\XLite\Module\XC\Reviews\View\FormField\Input\Rating"
      fieldName="rating"
      rate="{entity.rating}"
      is_editable=true
      max="5" />
  </div>
</li>
