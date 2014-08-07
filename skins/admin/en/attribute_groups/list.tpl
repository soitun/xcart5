{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Attribute groups list table template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget class="XLite\View\Form\ItemsList\AttributeGroup\Table" name="list" />
  <widget class="XLite\View\ItemsList\Model\AttributeGroup" />
  <div class="button submit {getAdditionalPanelStyle()}">
    <widget class="\XLite\View\Button\Submit" label="{t(#Save changes#)}" style="main-button popup-submit" />
  </div>
<widget name="list" end />
<div class="note additional-panel {getAdditionalPanelStyle()}">{t(#Editing attribute groups on this page won't affect other product classes which use these groups#)}</div>
