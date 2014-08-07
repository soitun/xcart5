{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Minimum purchase quantities list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget class="XLite\Module\CDev\Wholesale\View\Form\MinQuantities" name="minQuantities" />

<table class="wholesale-minimum-quantity">
  <tr FOREACH="getMinQuantities(),qty">
    <list name="wholesale.minquantity" qty="{qty}" />
  </tr>
</table>

<widget class="\XLite\View\Button\Submit" label="Save changes" style="main-button" />

<widget name="minQuantities" end />
