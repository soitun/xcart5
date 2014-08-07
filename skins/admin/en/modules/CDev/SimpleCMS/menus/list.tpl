{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Menus list table template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget class="XLite\Module\CDev\SimpleCMS\View\Form\ItemsList\Menu\Table" name="list" />
  <widget 
    IF="{isVisibleShowDefaultOption()}"
    class="XLite\View\FormField\Input\Checkbox"
    isChecked="{config.XC.SimpleCMS.show_default_menu}"
    value="Y"
    fieldName="show_default_menu" 
    label="Show default menu along with the custom one" />
  <widget class="XLite\Module\CDev\SimpleCMS\View\ItemsList\Model\Menu" />
<widget name="list" end />