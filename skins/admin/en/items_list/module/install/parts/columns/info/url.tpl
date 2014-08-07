{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Modules main description section list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.module.install.columns.module-description-section", weight="30")
 * @ListChild (list="itemsList.module.manage.columns.module-description-section", weight="30")
 *}

<div class="module-url" IF="module.getPageURL()">
  <a href="{module.getPageURL()}" target="_blank" class="module-page-link form-external-link" data-store-url="{getStoreURL()}" data-email="{getUserEmail()}">{t(#Module page#)}<i class="icon fa fa-external-link"></i></a>
</div>
