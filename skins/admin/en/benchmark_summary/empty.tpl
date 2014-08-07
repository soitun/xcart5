{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Benchmark summary - empty variant
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="speed"></div>
<p>{t(#Estimate your server performance#)}</p>
<div class="buttons">
  <widget class="\XLite\View\Button\Link" location="{buildURL(#measure#,#measure#)}" label="{t(#Run benchmark#)}" style="action" />
  <widget
    class="\XLite\View\Tooltip"
    id="measure-help-text"
    text="{t(#The benchmark evaluates server environment#):h}"
    caption="{t(#What is benchmark?#)}"
    isImageTag="false"
    className="help" />
</div>
<span class="help-text" style="display: none;">{t(#The benchmark evaluates server environment#):h}</span>
