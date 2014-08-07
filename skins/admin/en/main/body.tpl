{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Welcome page for logged admin
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="{getBoxClass()}">
  <div class="inner-box">
    <list IF="isRootAccess()" name="dashboard-center.welcome" />
    <list IF="!isRootAccess()" name="dashboard-center.welcome.non-root" />
  </div>
</div>

