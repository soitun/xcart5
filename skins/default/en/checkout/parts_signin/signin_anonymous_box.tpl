{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Sign-in
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="signin-anonymous-title", weight="200")
 *}
<widget
  class="\XLite\View\Button\Link"
  location="{buildURL(#checkout#,#update_profile#,_ARRAY_(#email#^##,#same_address#^#1#))}"
  label="{t(#Continue#)}" />
