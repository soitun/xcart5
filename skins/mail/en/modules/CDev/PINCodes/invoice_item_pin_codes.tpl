{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Pincodes item cell
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.item.name", weight="10")
 *}
<div IF="item.countPinCodes()">
  {t(#PIN#)}:
  <span FOREACH="item.getPinCodes(),pin" style="padding-left:5px">
    {pin.code}
  </span>
</div>
