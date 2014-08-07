{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Common input template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<span class="input-field-wrapper {getWrapperClass()}">
  {displayCommentedData(getCommentedData())}
  <input{getAttributesCode():h} />
</span>
<div IF="getParam(#suffix#)" class="clean-url-suffix">{getParam(#suffux#)}</div>
<widget 
  class="XLite\View\FormField\Input\Checkbox\AutogenerateCleanURL" 
  fieldName="{getNamePostedData(#autogenerateCleanURL#)}" 
  value="{getParam(#disabled#)}" 
  fieldOnly="true"
  label="" />
<div class="table-label autogenerate-label">
  <label for="posteddata-autogeneratecleanurl">{t(#Autogenerate Clean URL#)}</label>
</div>

