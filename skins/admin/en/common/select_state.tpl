{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Select state
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
{if:isCustomState()}
  <input type="text" name="{field}"{if:fieldId} id="{fieldId}"{end:} class="{getParam(#className#)} field-state {if:isLinked} linked{end:}" value="{getStateValue()}" />
{else:}
  <select name="{field}"{if:fieldId} id="{fieldId}"{end:} class="{getParam(#className#)} field-state {if:isLinked} linked{end:}">
   <option FOREACH="getStates(),v" value="{v.getStateId():r}" selected="{v.getStateId()=state.getStateId()}">{v.state}</option>
  </select>
{end:}
<script IF="isDefineStates()" type="text/javascript">
{getJSDataDefinitionBlock():h}
</script>
