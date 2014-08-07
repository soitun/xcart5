{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Modules main section list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.module.manage.columns.module-main-section", weight="30")
 *}

<div IF="!module.canDisable()" class="note dependencies">

  {t(#Can't be disabled. The module is required by:#)}

  <ul>
    <li FOREACH="module.getDependentModules(),depend">
      <a href="#{depend.getName()}">{depend.getModuleName()} ({t(#by#)} {depend.getAuthorName()})</a>
    </li>
  </ul>

</div>
