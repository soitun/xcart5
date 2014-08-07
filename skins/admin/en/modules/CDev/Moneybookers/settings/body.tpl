{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Skrill settings
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<p class="mb-register-note">{t(#To have access to the International payment network of Skrill please register here for a free account if you don't have one yet.#,_ARRAY_(#url#^getRegisterURL())):h}</p>

<form action="{buildURL()}" method="post" class="mb-activation">
  <input type="hidden" name="target" value="{target}" />
  <input type="hidden" name="action" value="activate" />
  <widget class="\XLite\View\FormField\Input\FormId" />

  <ul>

    <li class="mb-email">
      <label for="mb_email">{t(#Email address of your Skrill account#)}:</label>
      <input type="text" id="mb_email" name="email" value="{config.CDev.Moneybookers.email}"/>
      <widget class="\XLite\View\Button\Submit" label="Validate Email" />
    </li>

    <li class="mb-id">
      <label for="mb_id">{t(#Skrill Customer ID#)}:</label>
      <input type="text" id="mb_id" name="id" value="{config.CDev.Moneybookers.id}" />
    </li>

  </ul>

  <div class="buttons">
    <widget class="\XLite\View\Button\Submit" label="Activate Skrill Quick Checkout" style="action" />
  </div>

  <p class="mb-activation-note">{t(#Skrill Quick Checkout enables you to take direct payment from credit cards, debit cards and over 60 other local payment options in over 200 countries as well as the Skrill eWallet.#):h}</p>

</form>

<hr class="mb-line" />

{if:config.CDev.Moneybookers.email}

<form action="{buildURL()}" method="post" class="mb-secret-word">
  <input type="hidden" name="target" value="{target}" />
  <input type="hidden" name="action" value="validateSecretWord" />
  <widget class="\XLite\View\FormField\Input\FormId" />

  <p class="mb-secret-word-note">{t(#After activation Skrill will give you access to a new section in your Skrill account called "Merchant tools". Please choose a secret word (do not use your password for this) and enter it into the merchant tools section and below.#)}</p>

  <ul>

    <li>
      <label for="mb_word">{t(#Secret Word#)}:</label>
      <input type="password" id="mb_word" name="secret_word" value="{config.CDev.Moneybookers.secret_word}" />
      <widget class="\XLite\View\Button\Submit" label="Validate Secret Word" />
    </li>

  </ul>

</form>
{end:}

<form action="{buildURL()}" method="post" class="mb-order-prefix">
  <input type="hidden" name="target" value="{target}" />
  <input type="hidden" name="action" value="setOrderPrefix" />
  <widget class="\XLite\View\FormField\Input\FormId" />

  <p class="mb-order-prefix-note">{t(#You can define an order id prefix, which would precede each order number in your shop, to make it unique (each transaction id must be unique for a Skrill account)#)}</p>
  <p class="mb-order-prefix-option">{t(#This options is relevant only if you share your Skrill account with other online shops.#)}</p>


  <ul>

    <li>
      <label for="mb_order_prefix">{t(#Order id prefix#)}:</label>
      <input type="text" id="mb_order_prefix" name="prefix" value="{config.CDev.Moneybookers.prefix}" />
      <widget class="\XLite\View\Button\Submit" label="Submit" />
      <div>{t(#(optional)#)}</div>
    </li>

  </ul>

</form>

<hr class="mb-line" />

<p class="mb-support-note">
  {t(#Support#)}:<br />
  {t(#Do you have questions?#)}<br />
  {t(#Contact Skrill on ecommerce@skrill.com or by phone +44 (0) 870 383 0762#):h}
</p>
