{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Modules main section list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.module.manage.columns.module-main-section", weight="40")
 *}

<div IF="isModuleUpdateAvailable(module)" class="note version upgrade">
  {t(#Version#)}:&nbsp;{getModuleVersion(getModuleForUpdate(module))}&nbsp;{t(#is available#)}<br />
  <a href="{buildURL(#upgrade#,##,_ARRAY_(#mode#^#install_updates#))}">{t(#Update module#)}</a>
</div>
