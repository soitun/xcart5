{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Wholesale prices table
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="wholesale.price.widgetlist", weight="60")
 *}

<td IF="wholesalePrice.getSavePriceValue()=0">
  <span class="save-price-value-null">&nbsp;</span>
</td>
