{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Account link
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="layout.header.bar.links.logged", weight="200")
 *}

<li class="account-link-2">
  <a href="{buildURL(#order_list#,##)}" class="register">{t(#My account#)}</a>
  <span class="email">({auth.profile.login})</span>
</li>
