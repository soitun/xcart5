{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Import progress section
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="dialog-block import-box import-progress">

  <widget class="XLite\View\Import\Titles" />

  <div class="content">
    <widget class="XLite\View\Form\Import" name="importform" formAction="cancel" />
      <div class="subcontent">
        <widget class="XLite\View\EventTaskProgress" event="{getEventName()}" />
        <widget class="XLite\View\Button\Submit" label="{t(#Cancel#)}" />
        <div class="rows-processed">{t(#Initializing...#)}</div>
      </div>
      <div class="help">
        <i class="icon-info-sign"></i>
        <p>
          {if:isBlocking()}
            {t(#The process of import may take much time. You may close the page, the operation will be in progress as background. If the operation takes long enough, we will send you a notification when it is complete.#)}
          {else:}
            {t(#The process of import may take much time. Please do not close this page until the import is complete#)}
          {end:}
        </p>
      </div>
    <widget name="importform" />
  </div>

</div>
