{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Language label name cell
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="language-labels">

  <div class="label-name">

    <ul class="lng-marks" IF="isSeveralLanguagesExists()">
      <li FOREACH="getLanguageMarks(entity),code,lng"><span class="{lng.status}">{code}</span></li>
    </ul>

    <ul class="lng-marks">
      <li><span class="open-edit-box">{t(#Edit#)}</span></li>
    </ul>
    
    <span class="name">{entity.getName()}</span>

    <img src="skins/admin/en/images/spacer.gif" class="right-fade" alt="">

  </div>

  <div class="label-edit" style="display: none;">

    <div class="left" IF="isTranslatedLanguageSelected()">
      <div class="lng-title">{translationLanguageObject.name}</div>
      <textarea
        name="translated[{entity.label_id}]"
        lang="{translationLanguageObject.code}"
        xml:lang="{translationLanguageObject.code}"
        {if:translationLanguageObject.r2l} dir="rtl"{end:}>{getLabelTranslatedValue(entity)}</textarea>
    </div>

    <div class="right">
      <div class="lng-title">{defaultLanguageObject.name} ({t(#default#)})</div>
      <textarea
        {if:isDefaultLanguageNonEditable()}
        readonly="readonly"
        class="non-editable"
        {else:}
        name="current[{entity.label_id}]"
        {end:}
        lang="{defaultLanguageObject.code}"
        xml:lang="{defaultLanguageObject.code}"
        {if:defaultLanguageObject.r2l} dir="rtl"{end:}>{getLabelDefaultValue(entity)}</textarea>
    </div>

  </div>

  <div class="clear"></div>

</div>
