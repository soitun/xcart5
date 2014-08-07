{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Install updates or not (select installation type)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<form action="{buildURL()}" method="post" class="no-popup-ajax-submit">
  <input type="hidden" name="target" value="upgrade" />
  <input type="hidden" name="action" value="install_addon" />
  {foreach:getModuleIds(),id}
  <input type="hidden" name="moduleIds[]" value="{id}" />
  {end:}
  <widget class="\XLite\View\FormField\Input\FormId" />

  <div class="install-warning-description">
    {t(#The system detects that some updates are available for enabled modules. It is strongly recommended to have all enabled modules updated to latest version for better compatibility before the install new ones from Marketplace.#)}
  </div>

  <list name="installation_types.buttons" />

  <div class="clear"></div>

</form>
