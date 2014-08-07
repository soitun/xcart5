{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Canada Post products return: created line
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="capost_return", weight="100")
 *}

<p class="title">
  {t(#Created on#)} <span class="date">{getCreateDate()}</span> {t(#by#)}
  <a IF="hasProfilePage()" class="name" href="{getProfileURL()}">{getProfileName()}</a>
  <span IF="!hasProfilePage()" class="name">{getProfileName()}</span>
  <span IF="getMembership()" class="membership">({membership.getName()})</span>
</p>
