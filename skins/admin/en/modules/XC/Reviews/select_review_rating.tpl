{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Review rating selection template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<select name="rating">
  <option value="%" IF="{getParam(#allOption#)}" selected="{isSelected(#%#,getParam(#value#))}">{t(#Any rating#)}</option>
  {foreach:getRatingsList(),key,title}
  <option value="{key}"{if:isSelected(key,getParam(#value#))} selected="selected"{end:}>{title}</option>
  {end:}
</select>
