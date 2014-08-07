{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Modules list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.module.manage.columns.icon", weight="200")
 * @ListChild (list="itemsList.module.install.columns.icon", weight="200")
 *}

<div class="addon-icon">
  <img IF="module.hasIcon()" src="{module.getIconURL()}" class="addon-icon" alt="{module.getModuleName()}" />
  <img IF="!module.hasIcon()" src="images/spacer.gif" class="addon-icon addon-default-icon" alt="{module.getModuleName()}" />
</div>
