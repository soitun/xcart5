{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Common selector
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<select id="{getFieldId()}" name="{getName()}"{getAttributesCode():h}>
  <option FOREACH="getOptions(),optionValue,optionLabel" value="{optionValue}" selected="{optionValue=getValue()}">{optionLabel:h}</option>
</select>
