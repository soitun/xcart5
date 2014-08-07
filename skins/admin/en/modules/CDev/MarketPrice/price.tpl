{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product element
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.modify.list", weight="550")
 *}

<tr>
  <td class="name-attribute">{t(#Market price#)}</td>
  <td class="star">&nbsp;</td>
  <td class="value-attribute">
    <input type="text" name="{getNamePostedData(#marketPrice#)}" size="18" value="{product.marketPrice}" />
  </td>
</tr>
