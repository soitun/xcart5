{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Regular button
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="modules-not-selected{if:countModulesSelected()>0} hide-selected{end:}">{t(#Not selected#)}</div>
<div class="modules-selected-box actions{if:countModulesSelected()=0} hide-selected{end:}">
<div class="module-box clone">
  <div class="remove-action"><span class="info"></span></div>
  <span class="module-name"></span>
</div>
{foreach:getModulesToInstall(),moduleId}
<div class="always-enabled module-box" id="module-box-{moduleId}">
  <div class="remove-action"><span class="info">{moduleId}</span></div>
  <span class="module-name">{getModuleName(moduleId)}</span>
</div>
{end:}
</div>
