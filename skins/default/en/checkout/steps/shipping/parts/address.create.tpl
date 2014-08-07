{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Create profile checkbox
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<p class="subbox subnote create-warning">
  {t(#There is already an account with your email address. You can sign in or continue as guest#,_ARRAY_(#URL#^buildURL(#login#))):h}
</p>

<div class="subbox create">
  <input type="checkbox" id="create_profile" name="create_profile" value="1" checked="{isCreateProfile()}" />
  <label for="create_profile">{t(#Create an account for later use#)}</label>
</div>
