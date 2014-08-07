{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Attributes list table template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget class="XLite\View\Form\ItemsList\Attribute\Table" name="list" />
<widget class="XLite\View\ItemsList\Model\Attribute" />
{foreach:getAttributeGroups(),group}
  <widget class="XLite\View\ItemsList\Model\Attribute" group="{group}" />
{end:}
<widget name="list" end />
