{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{* TODO (FlexyCompiler) - improve the approach to access array fields *}
{* TODO (FlexyCompiler) - add the ability to use constants *}

<div FOREACH="getFormFieldsForDisplay(),section,data" class="section {section}-section">
  <div class="header {section}-header" IF="{isShowSectionHeader(section)}">{data.sectionParamWidget.display()}</div>
  <ul class="table {section}-table">
    <li FOREACH="data.sectionParamFields,field" class="{field.getWrapperClass()}">{field.display()}</li>
  </ul>
</div>
