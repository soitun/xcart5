{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Switcher button
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<input type="hidden" name="{getName()}" value="{getEnabled()}" />
<button type="button" class="{getStyle()}" title="{t(getTitle())}" data-lbl-enable="{t(#Enable#)}" data-lbl-disable="{t(#Disable#)}">
  <img src="images/spacer.gif" alt="" />
</button>
