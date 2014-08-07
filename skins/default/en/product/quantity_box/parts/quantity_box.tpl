{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Main element (input)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.quantity-box", weight="20")
 *}

<input
  type="text"
  value="{getBoxValue()}"
  class="{getClass()}"
  id="{getBoxId()}"
  name="{getBoxName()}"
  title="{t(getBoxTitle())}" />
<span class="wheel-mark">&nbsp;</span>
