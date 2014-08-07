{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Change attribute values
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div IF="hasErrorMessage()" id="status-messages-popup">{getErrorMessage()}</div>
<widget class="\XLite\View\Form\ChangeAttributeValues" name="change_attribute_values" className="change-attribute-values" />
  <widget class="\XLite\View\Product\AttributeValues" />

  <div class="buttons">
    <widget class="\XLite\View\Button\Submit" label="Change" />
  </div>

<widget name="change_attribute_values" end />
