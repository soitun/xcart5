{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Add to Cart popup page: added product box template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="add2cart_popup.item", weight="100")
 *}

<div class="item-thumbnail">
  <widget class="\XLite\View\Image" image="{product.getImage()}" maxWidth="{getIconWidth()}" maxHeight="{getIconHeight()}" alt="{product.name}" className="photo" />
</div>
