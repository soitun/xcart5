{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Modules list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="marketplace.top-controls", weight="400")
 *}

<widget class="\XLite\View\Form\Module\Install" name="modules_install_form" />
  <div class="marketplace-wrapper{if:isLandingPage()} marketplace-landing{end:}">
    <widget template="{getBody()}" />
  </div>
  <widget class="XLite\View\StickyPanel\ItemsList\InstallModules" />
<widget name="modules_install_form" end />
