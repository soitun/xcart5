{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Image upload template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<input type="file" name="{getNamePostedData(getParam(#field#))}" />&nbsp;&nbsp;&nbsp;
<widget class="\XLite\View\Button\Regular" IF="hasImage()" label="{t(#Delete#)}" jsCode="document.{formName}.{field}_delete.value='1';document.{formName}.action.value='{actionName}';document.{formName}.submit()" />
<input type="hidden" value="0" name="{getParam(#field#)}_delete" />

<br />

{*<input type="checkbox" name="{getParam(#field#)}_filesystem" value="1" checked="{isFS()}" /> Upload to file system*}

<br />
