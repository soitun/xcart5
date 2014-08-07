{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Edit label
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="edit-label-dialog label-dialog">

  <h2>{t(#Edit label#)}</h2>

  {t(#Please specify text labels for each language#)}

  <widget class="\XLite\View\Form\Translations\Labels" formAction="edit" name="label_details_form" />

    <ul>

      <li>
        <label for="edit_name" class="label-name">{t(#Label name#)}</label>
        <input type="text" id="edit_name" name="name" value="{label.name}" readonly="readonly" class="name" />
      </li>

      <li FOREACH="getAddedLanguages(),l">
        <label for="edit_label_{l.code}" class="language" style="background-image: url({l.flagURL});">{l.name}<span IF="isRequiredLanguage(l)"> ({t(#default#)})</span></label>
        <textarea id="edit_label_{l.code}" name="label[{l.code}]" lang="{l.code}" xml:lang="{l.code}"{if:l.r2l} dir="rtl"{end:}>{getTranslation(l.code)}</textarea>
      </li>

    </ul>

    <widget class="\XLite\View\StickyPanel\Language\LabelDetails" />

  <widget name="label_details_form" end />

</div>
