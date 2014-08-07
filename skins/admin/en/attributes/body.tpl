{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Attributes page template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="buttons"{if:productClass} data-class-id="{productClass.getId()}{end:}" />
  <widget class="\XLite\View\Button\Submit" style="new-attribute" label="{t(#New attribute#)}" />
  <widget class="\XLite\View\Button\Submit" style="manage-groups" label="{t(#Manage groups#)}" />
</div>

{if:isListVisible()}
<widget template="common/dialog.tpl" body="attributes/list.tpl" />
{else:}
{t(#No attributes are defined for the product class yet.#)}
{end:}
