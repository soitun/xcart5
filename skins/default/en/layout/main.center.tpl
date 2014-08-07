{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Center zone
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="layout.main", weight="400")
 *}

<div id="main-wrapper">
  {if:isForceChangePassword()}
  <div id="main" class="force-change-password-section clearfix">
    <widget class="\XLite\View\Model\Profile\ForceChangePassword" />
  </div>
  {else:}
  <div id="main" class="clearfix">
    <list name="layout.main.center" />
  </div>
  {end:}
</div>
