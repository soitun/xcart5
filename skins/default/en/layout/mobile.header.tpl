{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Mobile header
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 *}

<div class="mobile_header">
  <ul class="nav nav-pills">
    <li class="dropdown">
      <a id="main_menu" class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-bars"></span></a>
      <div id="top-menu" class="dropdown-menu">
        <list name="header.menu" />
        <ul class="language_list">

          <list name="header.language.menu" />
        </ul>
      </div>
    </li>
    <li class="dropdown">
      <a id="search_menu" class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-search"></span></a>
      <ul id="search_box" class="dropdown-menu" >
        <li role="presentation">
          <list name="layout.responsive.search" />
        </li>
      </ul>
    </li>
    <li class="dropdown">
      <a id="account_menu" class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-user"></span></a>
      <ul id="account_box" class="dropdown-menu">
        <li role="presentation">
          <list name="layout.responsive.account" />
        </li>
      </ul>
    </li>
  </ul>
</div>
