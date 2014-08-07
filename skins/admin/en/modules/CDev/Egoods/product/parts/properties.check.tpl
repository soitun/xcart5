{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Private state
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="egoods-private-state">
  <input type="hidden" name="data[{attachment.getId()}][private]" value="" /> 
  <input type="checkbox" class="check" id="attachmentPrivate{attachment.getId()}" name="data[{attachment.getId()}][private]" value="1"{if:attachment.getPrivate()} checked="checked" {end:} />
  <label for="attachmentPrivate{attachment.getId()}">{t(#Can be downloaded only after buying the product#)}</label>
  <span>[<a href="{buildURL(#module#,##,_ARRAY_(#moduleId#^getModuleId(),#return#^getURL()))}">{t(#Global eGood settings#)}</a>]</span>
</div>
