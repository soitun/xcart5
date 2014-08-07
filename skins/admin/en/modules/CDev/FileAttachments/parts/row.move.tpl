{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Move pointer
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.attachments.row", weight="100", zone="admin")
 *}
<a href="#" class="move" title="{t(#Move#)}"><img src="images/spacer.gif" alt="" /></a>
<input type="hidden" class="orderby" name="data[{attachment.getId()}][orderby]" value="{attachment.getOrderby()}" />
