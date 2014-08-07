{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Editable option
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<label class="inline-checkbox editable-checkbox">
  <input type="hidden" name="{getName(#editable#)}" value="0" />
  <input type="checkbox" name="{getName(#editable#)}"{if:isEditable()} checked="checked"{end:} />
  <span>{t(#editable#)}</span>
</label>

