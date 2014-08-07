{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product details image block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.details.page", weight="20")
 *}

<div class="image{if:!product.hasImage()} empty{end:}" style="width: {getMaxImageWidth()}px;">
  <list name="product.details.page.image" />
</div>
