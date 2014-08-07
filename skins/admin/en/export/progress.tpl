{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Export progress section
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="dialog-block export-box export-progress">

  <div class="header clearfix">
    <h2>{t(#Exporting data...#)}</h2>
  </div>

  <div class="content">
    <widget class="XLite\View\Form\Export" name="exportform" formAction="cancel" />
      <div class="subcontent">
        <widget class="XLite\View\EventTaskProgress" event="{getEventName()}" />
        <widget class="XLite\View\Button\Submit" label="{t(#Cancel#)}" />
        <div class="time">{t(#About X remain#,_ARRAY_(#time#^getTimeLabel()))}</div>
      </div>
      <div class="help">
        <i class="icon-info-sign"></i>
        <p>
          {if:isBlocking()}
            {t(#The process of export may take much time. You may close the page, the operation will be in progress as background. If the operation takes long enough, we will send you a notification when it is complete.#)}
          {else:}
            {t(#The process of export may take much time. Please do not close this page until the export is complete#)}
          {end:}
        </p>
      </div>
    <widget name="exportform" />
  </div>

</div>

