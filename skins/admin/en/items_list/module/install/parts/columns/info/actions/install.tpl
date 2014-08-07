{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Module select to install action widget
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<label for="install-{module.getModuleId()}" class="install-module-button">
  <input
    id="install-{module.getModuleId()}"
    type="checkbox"
    data="{module.getModuleId()}"
    name="selectToInstall[{module.getModuleId()}]"
    {if:isModuleSelected(module.getModuleId())}checked="checked"{end:}
    class="install-module-action" />
  {t(#Install#)}
</label>
