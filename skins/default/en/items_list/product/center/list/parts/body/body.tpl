{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Item body
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.list.customer.body", weight="40")
 *}

<td class="body">
  <div class="quick-look-cell">
    <list name="quicklook.info" type="nested" />
    <list name="info" type="nested" product="{product}" />
  </div>
</td>
