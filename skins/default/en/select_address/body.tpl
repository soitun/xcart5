{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Pick address from address book
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<widget class="\XLite\View\Form\SelectAddress" name="selectAddress" className="select-address" />

  {if:hasAddresses()}

    <ul class="addresses">
      <li FOREACH="getAddresses(),address" class="{getItemClassName(address,addressArrayPointer)}">
        <widget template="select_address/address.tpl" address="{address}" />
        <div IF="address.getIsShipping()" class="shipping"></div>
        <div IF="address.getIsBilling()" class="billing"></div>
      </li>
    </ul>

  {else:}

    <p>{t(#Addresses list is empty#)}</p>

  {end:}

<widget name="selectAddress" end />
