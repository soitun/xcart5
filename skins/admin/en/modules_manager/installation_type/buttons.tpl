{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Install updates or not (select installation type)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="installation_types.buttons")
 *}

  <ul class="actions">
    <li class="button">
      <widget
        class="\XLite\View\Button\Regular"
        label="{t(#Install anyway#)}"
        action="install_addon_force" />
    </li>
    <li class="or">{t(#or#)}</li>
    <li class="button">
      <widget class="\XLite\View\Button\Submit" label="{t(#Update modules#)}" />
    </li>
  </ul>
