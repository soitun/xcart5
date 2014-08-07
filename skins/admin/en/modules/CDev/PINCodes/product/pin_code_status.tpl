{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Pin codes status box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}


{foreach:getFields(),f}
  {if:isSold(f)}
    <div class="pin-sold">{t(#Sold#)}</div>
    {if:isDeleted(f)}
      ( {t(#Order deleted#)} )
    {else:}
      ( <a target="_blank" href="{getOrderUrl(f):h}">#{getOrderNumber(f):h}</a> )
    {end:}
  {end:}
{end:}

