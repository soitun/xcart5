{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.inventory.parts", weight="20")
 *}

<tr>
  <td>{t(#Quantity in stock#)}</td>
  <td>
    <input type="text" name="{getNamePostedData(#amount#)}" size="18" value="{inventory.getAmount()}" />
  </td>
</tr>
