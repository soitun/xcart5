{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Canada Post offices list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{if:isSelectedMethodSupportDeliveryToPO()}

  <widget class="\XLite\Module\XC\CanadaPost\View\Form\Checkout\PostOffice" name="capostOffices" className="capost-offices-form" />

    <div class="capost-offices-head">
      <input type="hidden" name="capostDeliverToPO" value="0" />
      <input type="checkbox" id="capost-deliver-to-po" name="capostDeliverToPO" checked="{hasCartCapostOffice()}" value="1" />
      <label for="capost-deliver-to-po">{t(#Deliver to Post Office#)}</label>
    </div>
    
    {if:getNearestCapostOffices()}
  
      <ul class="capost-offices-list {if:isOfficesListVisible()}offices-visible{else:}offices-invisible{end:}">
        <li FOREACH="getNearestCapostOffices(),office">
          <input type="radio" id="capost-office-id-{office.getId()}" name="capostOfficeId"{if:isCapostOfficeSelected(office)} checked="checked"{end:} value="{office.getId()}" />
          <label for="capost-office-id-{office.getId()}">
            <span class="office-line office-title">{office.getName()}<img src="images/spacer.gif" alt="" class="fade" /></span>
            <div class="office-line office-descr">{office.getOfficeAddress()}</div>
            <div class="office-line office-descr">{office.getCity()}, {office.getProvince()}, {office.getPostalCode()}</div>
          </label>
        </li>
      </ul>
  
    {else:}

      <p class="capost-offices-note">{t(#There's no post offices available#)}</p>

    {end:}

  <widget name="capostOffices" end />

{end:}
