{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shopping cart item : thumbnail
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="cart.item", weight="20")
 *}
<td class="item-thumbnail" IF="item.hasImage()"><a href="{item.getURL()}"><widget class="\XLite\View\Image" image="{item.getImage()}" alt="{item.getName()}" maxWidth="80" maxHeight="80" centerImage="0" /></a></td>
<td class="item-thumbnail" IF="!item.hasImage()">&nbsp;</td>
