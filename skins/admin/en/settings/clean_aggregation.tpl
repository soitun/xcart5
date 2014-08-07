{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Email footer
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="crud.settings.footer", zone="admin", weight="100")
 *}
 
<div IF="page=#Performance#" class="clean-aggregation-cache">
  <widget
    class="\XLite\View\Button\Regular"
    style="clean-aggregation-cache"
    label="Clean aggregation cache"
    jsCode="self.location='{buildURL(#css_js_performance#,#clean_aggregation_cache#)}'" />
  <widget
    class="\XLite\View\Tooltip"
    id="clean-aggregation-help-text"
    text="{t(#Clean aggregation cache help text#):h}"
    isImageTag=true
    className="help-icon" />
</div>