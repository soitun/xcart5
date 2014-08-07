{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Language selector
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{t(#Language#)}: 
<select name="language" onchange="window.location.href=this.options[this.selectedIndex].value">
  {foreach:getActiveLanguages(),language}
    <option value="{getChangeLanguageLink(language)}"{if:isLanguageSelected(language)} selected="selected"{end:}>
    {language.getName():h}
    </option>
  {end:}
</select>
