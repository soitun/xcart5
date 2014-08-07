<?php if ($this->isDeveloperMode()): ?><div  id="profiler-messages"></div><?php endif; ?>

<?php $this->getWidget(array(), '\XLite\View\TopMessage')->display(); ?>

<div id="page-wrapper" class="overlay-blur-base">

  <div id="header-wrapper">
    <?php $this->displayViewListContent('admin.main.page.header_wrapper'); ?>

    <div id="header">

      <?php $this->displayViewListContent('admin.main.page.header'); ?>

    </div><!-- [/header] -->
  </div><!-- [/header-wrapper] -->

  <div id="page-container"<?php if (!($this->get('auth')->isAdmin())){?> class="login-page"<?php }?>>

    <div id="content">
      <div id="content-header">

        <?php if ($this->isForceChangePassword()){?>
          <div id="main" class="force-change-password-section">
          <?php $this->getWidget(array(), '\XLite\View\Model\Profile\ForceChangePassword')->display(); ?>
          </div>
        <?php }else{ ?>
        <div id="leftSideBar">
          <?php $this->displayViewListContent('admin.main.page.content.left'); ?>
        </div>

        <div id="main">

          <?php $this->displayViewListContent('admin.main.page.content.center'); ?>

        </div><!-- [/main] -->
        <?php }?>

        <div id="sub-section"></div>

      </div>
    </div><!-- [/content] -->

  </div><!-- [/page-container] -->

</div><!-- [/page-wrapper] -->

<div id="footer" class="overlay-blur-base">
  <div class="footer-cell left">
    <?php $this->getWidget(array(), '\XLite\View\PoweredBy')->display(); ?>
  </div>
  <div class="footer-cell right">
    <?php $this->displayViewListContent('admin.main.page.footer.right'); ?>
  </div>
</div><!-- [/footer] -->
