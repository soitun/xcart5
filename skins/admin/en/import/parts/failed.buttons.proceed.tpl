{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Import failed section : button
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="import.failed.buttons", weight="200")
 *}

<widget class="XLite\View\Button\Link" jsCode="return false;" label="{t(#Proceed import#)}" style="main-button disabled" IF="{!isDisplayProceedButton()}" />
<widget class="XLite\View\Button\Link" location="{buildURL(#import#,#proceed#)}" label="{t(#Proceed import#)}" style="main-button" IF="{isDisplayProceedButton()}" />
