{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * 'Use separate box' related fields block template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<ul>
  <li>
    <div>{t(#Length x Width x Height#)} ({getDimSymbol()}):</div>
    <div>
      <input type="text" name="{getNamePostedData(#boxLength#)}" size="9" value="{product.boxLength}" />
      x
      <input type="text" name="{getNamePostedData(#boxWidth#)}" size="9" value="{product.boxWidth}" />
      x
      <input type="text" name="{getNamePostedData(#boxHeight#)}" size="9" value="{product.boxHeight}" />
    </div>
  </li>
  <li>
    <div>{t(#Maximum number of items per box#)}:</div>
    <div>
      <input type="text" name="{getNamePostedData(#itemsPerBox#)}" size="8" value="{product.itemsPerBox}" />
    </div>
  </li>
</ul>
