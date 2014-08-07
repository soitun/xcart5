{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Export begin section
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="dialog-block export-box export-begin">

  <div class="header clearfix">
    <h2>{t(#Export in CSV#)}</h2>
  </div>

  <div class="content">
    <widget class="XLite\View\Form\Export" name="exportform" />
      <div class="subcontent clearfix">
        <list name="export.begin.content" />
      </div>
      <div class="buttons">
        <list name="export.begin.buttons" />
      </div>
    <widget name="exportform" />
  </div>

</div>

<widget class="XLite\View\Export\Download" />
