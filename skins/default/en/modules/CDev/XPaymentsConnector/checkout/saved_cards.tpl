{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * iframe 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{if:profile.getSavedCards()}
<div class="saved-cards-box xpc-box"{if:!checkCheckoutAction()} style="display: none;"{end:}>

  <p>{t(#Pay with previously used credit card#)}</p>

  <ul class="saved-cards">

    {foreach:profile.getSavedCards(),cc}
      <li {if:!cc.is_default}class="saved-cards-hidden"{end:}>
        <input type="radio" name="payment[saved_card_id]" value="{cc.card_id}"{if:cc.is_default} checked="checked"{end:} class="saved-cards-hidden" id="saved_card_{cc.card_id}" />
        <label for="saved_card_{cc.card_id}">
          <span class="card-icon-container">
            <span class="card {cc.card_type_css}"></span>
            <img src="images/spacer.gif" alt="{cc.card_type}" />
          </span>
          <span class="number">{cc.card_number}</span>
        </label>
      </li>
    {end:}
  </ul>

  <p class="switch-cards-link">
    <a href="javascript: void(0);" onclick="javascript: $('.saved-cards-hidden').show(); $('.switch-cards-link').hide();" >{t(#Show all saved credit cards#)}</a>
  </p>

</div>
{end:}
