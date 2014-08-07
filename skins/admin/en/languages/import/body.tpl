{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Import language widget template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="import-language-dialog">

  <widget class="\XLite\View\Form\Translations\LanguageImport" name="language_import_form" />

  <div class="content" IF="isSuccess()">

    <div class="description">

      <div IF="!isImportFinished()">{t(#The provided file contains the following language labels:#)}</div>
      <div IF="isImportFinished()">{t(#The language labels have been successfully imported:#)}</div>

      <ul>
        <li FOREACH="importFileData.codes,id,data">{t(#Language:#)} <span>{data.language} [{data.code}]</span>, {t(#labels count:#)} <span>{data.labels_count}</span></li>
        <li>{t(#Number of ignored rows:#)} <span{if:importFileData.ignored} class="red"{end:}>{importFileData.ignored}</span></li>
      </ul>

      <div IF="!isImportFinished()">{t(#Please confirm if you want proceed with the import otherwise cancel the operation.#)}</div>

    </div>

    <div class="actions">
      <widget class="\XLite\View\Button\Regular" label="Import" jsCode="self.location='{buildURL(#language_import#,#import#)}'" IF="!isImportFinished()"/>
      <widget class="\XLite\View\Button\Regular" label="Cancel" jsCode="self.location='{buildURL(#language_import#,#cancel_import#)}'" IF="!isImportFinished()" />
      <widget class="\XLite\View\Button\Regular" label="Finish" jsCode="self.location='{buildURL(#language_import#,#cancel_import#)}'" IF="isImportFinished()" />
    </div>

  </div>

  <div class="error" IF="!isSuccess()">
    <div class="title">{t(#Failure: File has the wrong format.#)}</div>
    <div class="message" IF="getMessage()">{getMessage()}</div>
    <div class="description">
      <div>{t(#The language CSV file should be a text file which contains 3 columns per row (columns are separated by comma:#)}</div>

      <ul>
        <li>{t(#language code,#)}</li>
        <li>{t(#label name,#)}</li>
        <li>{t(#label translation.#)}</li>
      </ul>

      <div>{t(#Please make sure your file format is as described.#)}</div>

    </div>
    <div class="actions">
      <widget class="\XLite\View\Button\Regular" label="Cancel" jsCode="self.location='{buildURL(#language_import#,#cancel_import#)}'" />
    </div>

  </div>

  <widget name="language_import_form" end />

  <div class="elapsed" IF="isDeveloperMode()">Elapsed: {importFileData.elapsed}</div>

</div>
