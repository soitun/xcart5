{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Canada Post Merchant registration wizard template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{if:isWizardEnabled()}

  <div class="admin-title">{t(#Merchant registration wizard#)}</div>

  <br />

  <span>{t(#To start registration process for Canada Post merchant account click on the "Register" button.#)}</span>

  <form action="{getMerchantRegUrl()}" method="post">

    <input type="hidden" name="return-url" value="{getWizardReturnUrl():r}" />
    <input type="hidden" name="token-id" value="{getTokenId()}" />
    <input type="hidden" name="platform-id" value="{getPlatformId()}" />

    <br />

    <widget class="\XLite\View\Button\Submit" label="Register" style="action" />

  </form>

{else:}

  <span>{t(#If you want to enable merchant registration wizard once again, please click on the following link#)} <a href="{buildURL(#capost#,#enable_wizard#)}" onclick="javascript: return confirm('{t(#Are you sure you want to continue?#)}');">{t(#enable merchant wizard#)}</a>.</span>

{end:}
