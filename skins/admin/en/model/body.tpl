{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<script IF="getTopInlineJSCode()" type="text/javascript">{getTopInlineJSCode():r}</script>
<widget template="{getDir()}/header.tpl" />

  <widget class="{getFormClass()}" name="{getFormName()}" />

    <div class="{getContainerClass()}">
      <widget template="{getDir()}/form_content.tpl" />
      <widget IF="!useButtonPanel()" template="{getDir()}/{getFormTemplate(#buttons#)}" />   
      <widget IF="useButtonPanel()" class="{getButtonPanelClass()}" />
    </div>

  <widget name="{getFormName()}" end />

<widget template="{getDir()}/footer.tpl" />

<script IF="getBottomInlineJSCode()" type="text/javascript">{getBottomInlineJSCode():r}</script>
