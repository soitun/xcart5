{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Layout
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div IF="isDeveloperMode()" id="profiler-messages"></div>

<div id="page-wrapper" class="overlay-blur-base">
  <div id="page" class="{if:isForceChangePassword()}force-change-password-page{end:}">
    <list name="layout.main" />
  </div>
  <list name="layout.footer" />
</div>
