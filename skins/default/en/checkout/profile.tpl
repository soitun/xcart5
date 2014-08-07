{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Profile block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="profile">
  {if:isAnonymous()}
    <widget template="checkout/profile/anonymous.tpl" />
  {else:}
    <widget template="checkout/profile/logged.tpl" />
  {end:}
</div>
