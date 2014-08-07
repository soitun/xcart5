{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Main template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div IF="isDeveloperMode()" id="profiler-messages"></div>

<widget class="\XLite\View\TopMessage" />

<div id="page-wrapper">

  <div id="header-wrapper">
    <list name="admin.main.page.header_wrapper" />

    <div id="header">

      <list name="admin.main.page.header" />

    </div><!-- [/header] -->
  </div><!-- [/header-wrapper] -->

  <div id="page-container"{if:!auth.isAdmin()} class="login-page"{end:}>

    <div id="content">
      <div id="content-header">

        {if:isForceChangePassword()}
          <div id="main" class="force-change-password-section">
          <widget class="\XLite\View\Model\Profile\ForceChangePassword" />
          </div>
        {else:}
        <div id="leftSideBar">
          <list name="admin.main.page.content.left" />
        </div>

        <div id="main">

          <list name="admin.main.page.content.center" />

        </div><!-- [/main] -->
        {end:}

        <div id="sub-section"></div>

      </div>
    </div><!-- [/content] -->

  </div><!-- [/page-container] -->

</div><!-- [/page-wrapper] -->

<div id="footer">
  <div class="footer-cell left">
    <widget class="\XLite\View\PoweredBy" />
  </div>
  <div class="footer-cell right">
    <list name="admin.main.page.footer.right" />
  </div>
</div><!-- [/footer] -->

