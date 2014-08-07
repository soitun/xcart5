{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Recomendation to upgrade kernel
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.module.manage.columns.module-main-section.cannot_enable.core_upgrade_needed", weight="200")
 * @ListChild (list="itemsList.module.install.columns.module-main-section.cannot_enable.core_upgrade_needed", weight="200")
 *}

<div IF="isCoreUpgradeAvailable(module.getMajorVersion())">
  {t(#Please#)} <a href="{buildURL(#upgrade#,##,_ARRAY_(#version#^module.getMajorVersion()))}">{t(#upgrade core#)}</a>
</div>
