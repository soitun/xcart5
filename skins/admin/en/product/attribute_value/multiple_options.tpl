{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Multiple options 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<label class="inline-checkbox multiple-checkbox">
  <input type="checkbox" tabindex="-1" name="{getName(#multiple#)}"{if:isMultiple()} checked="checked"{end:} />
  <span>{getMultipleTitle()}</span>
</label>
