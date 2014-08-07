{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Sign-in
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="signin.main", weight="10")
 *}
<div class="signin-wrapper">

  <div class="signin-login-wrapper">
    <div class="signin-login-title">{t(#Existing Customer?#)}</div>
    <div class="login-box"><list name="customer.checkout.signin" /></div>
  </div>

  <div class="or-line">
    <div class="line"></div>
    <div class="or-box">
      <div class="or">{t(#or#)}</div>
    </div>
  </div>

  <div class="signin-anonymous-wrapper">
    <div class="signin-anonymous-title">{t(#New to our store?#,_ARRAY_(#our store#^getStoreName()))}</div>
    <div class="signin-anonymous-box"><list name="signin-anonymous-title" /></div>
  </div>

</div>
