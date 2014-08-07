{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * X-Cart module notice
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.module.manage.columns.module-main-section", weight="200")
 *}
<div class="note error xcn-module-notice" IF="showXCNModuleNotice(module)">
<span>
{t(#Module available editions 1#,_ARRAY_(#list#^getEditions(module),#URL#^getPurchaseURL())):h}
  <widget class="\XLite\View\Button\ActivateKey" label="Activate existing key" />
</span>
</div>
