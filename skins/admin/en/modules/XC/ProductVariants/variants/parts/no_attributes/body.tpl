{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * No attributes
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="{getBlockStyle()}">
  <div class="header">
    <span class="title">{t(#The product does not have attributes with multiple options#)}</span>
    <widget
      class="\XLite\View\Tooltip"
      text="{t(#To set product variants you should select attributes with multiple options.#)}"
      isImageTag="true"
      className="help-icon" />
  </div>
  <div class="content">
    <widget class="\XLite\View\Button\Link" style="main-button" label="{t(#Add attributes#)}" location={buildURL(#product#,##,_ARRAY_(#product_id#^product.product_id,#page#^#attributes#))} />
  </div>
</div>
