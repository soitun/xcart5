{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Custom CSS template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="more-templates"><a href="{getXCartURL(#http://www.x-cart.com/extensions/xcart-templates.html#)}" target="_blank">{t(#More templates#)}</a> <i class="icon fa fa-external-link"></i></div>
<widget class="\XLite\Module\XC\ColorSchemes\View\Form\SelectSkin" name="form" />
  <widget class="\XLite\Module\XC\ColorSchemes\View\FormField\Select\SelectSkin"
    fieldName="skinName"
    fieldOnly="true"
    value="{getValue()}" onchange="getval(this);"/>
  <div id="skin_preview" class="{getValue()}">&nbsp;</div>
  <div class="buttons">
    <widget class="\XLite\View\Button\Submit" style="action" label="Save" />
  </div>
<widget name="form" end />
