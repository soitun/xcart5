{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Selector for Product classes
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div IF="!isListEmpty()" class="select-classes">
  <widget template="form_field/select.tpl" />
{* TODO Rework
<div class="classes-list">
{getSelectedClassesList()}<a href="javascript:void(0);" class="popup-classes"></a>
</div>
*}
</div>
<span IF="isListEmpty()" class="empty-list">
  <a href="{buildURL(#product_classes#)}">{t(#Define classes#)}</a>
</span>
