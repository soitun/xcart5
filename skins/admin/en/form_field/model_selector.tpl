{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Model selector
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="model-selector data-type-{getDataType()}" data-type="{getDataType()}">
{displayCommentedData(getCommentedData())}
  <input type="hidden" class="model-value" name="{getName()}" value="{getValue()}" />

  <input type="text" placeholder="{getParam(#placeholder#)}" class="{getCSSClasses()}"{if:getTextName()} name="{getTextName()}"{end:} value="{getTextValue()}" />

  <div class="spinner hidden"><div class="box"><div class="subbox"></div></div></div>

  <span class="no-items-found hidden">{getParam(#empty_phrase#)}</span>

  <span class="enter-more-characters hidden"></span>

  <span class="model-definition model-not-defined hidden">{getParam(#empty_model_definition#)}</span>

  <span class="model-definition model-is-defined hidden"></span>

  <ul class="items-list hidden"></ul>

</div>
