{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="address-dialog">

  <h2 IF="{address}">{t(#Change address#)}</h2>
  <h2 IF="{!address}">{t(#New address#)}</h2>

  <widget IF="{address}" class="\XLite\View\Model\Address\Address" modelObject="{address}" useBodyTemplate="1" />
  <widget IF="{!address}" class="\XLite\View\Model\Address\Address" profile_id="{profile_id}" useBodyTemplate="1" />

</div>
