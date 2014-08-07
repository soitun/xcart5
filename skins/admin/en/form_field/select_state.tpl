{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Select state
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @TODO move it to the common selector widget
 *}

<select id="{getFieldId()}" name="{getName()}"{getAttributesCode():h}>
  <option value="">{t(#Select one#)}</option>
  <option value="-1" selected="{getValue()=-1}">{t(#Other#)}</option>
  <option FOREACH="getOptions(),state" value="{state.state_id:r}" selected="{state.state_id=getValue()}">{state.state:h}</option>
</select>
