{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Add new label
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="add-new-label-dialog label-dialog">

  <h2>{t(#Add new label#)}</h2>

  {t(#Please specify text labels for each language#)}

  <widget class="\XLite\View\Form\Translations\Labels" formAction="add" name="label_details_form" />

    <ul>

      <li>
        <label for="new_name" class="label-name">{t(#Label name#)}<span> ({t(#required#)})</span></label>
        <input type="text" id="new_name" name="name" value="" class="field-required" />
      </li>

      <li FOREACH="getAddedLanguages(),l">
        <label for="new_label_{l.code}" class="language" style="background-image: url({l.flagURL});">{l.name}<span IF="isRequiredLanguage(l)"> ({t(#default#)})</span></label>
        <textarea id="new_label_{l.code}" name="label[{l.code}]" lang="{l.code}" xml:lang="{l.code}"{if:l.r2l} dir="rtl"{end:}></textarea>
      </li>

    </ul>

    <widget class="\XLite\View\StickyPanel\Language\LabelDetails" />

  <widget name="label_details_form" end />

</div>
