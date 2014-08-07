{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Email footer
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="crud.settings.footer", zone="admin", weight="200")
 *}

<div IF="page=#Performance#" class="clean-widgets-cache">
  <widget
    class="\XLite\View\Button\Regular"
    style="clean-widgets-cache"
    label="Clean widgets cache"
    jsCode="self.location='{buildURL(#css_js_performance#,#clean_view_cache#)}'" />
  <widget
    class="\XLite\View\Tooltip"
    id="clean-widgets-cache-help-text"
    text="{t(#Clean widgets cache help text#):h}"
    isImageTag=true
    className="help-icon" />
</div>