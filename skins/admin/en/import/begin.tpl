{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Import begin section
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="dialog-block import-box import-begin">

  <div class="header clearfix">
    <h2>{t(#Import by CSV#)}</h2>
  </div>

  <div class="content">
    <widget class="XLite\View\Form\Import" name="importform" />
      <div class="subcontent clearfix">
        <list name="import.begin.content" />
      </div>
      <div class="buttons">
        <list name="import.begin.buttons" />
      </div>
    <widget name="importform" />
  </div>

</div>
