{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Form start (order search)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<form action="{getFormAction()}" method="{getParam(#formMethod#)}" accept-charset="utf-8" onsubmit="javascript: {getJSOnSubmitCode()}" class="search-orders" style="display: none;">
<div class="form-params" style="display: none;">
  <input FOREACH="getFormParams(),paramName,paramValue" type="hidden" name="{paramName}" value="{paramValue}" />
</div>
