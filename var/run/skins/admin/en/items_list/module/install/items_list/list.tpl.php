<?php $this->getWidget(array(), '\XLite\View\Form\Module\Install', 'modules_install_form')->display(); ?>
  <div class="marketplace-wrapper<?php if ($this->isLandingPage()){?> marketplace-landing<?php }?>">
    <?php $this->display($this->getBody()); ?>
  </div>
  <?php $this->getWidget(array(), 'XLite\View\StickyPanel\ItemsList\InstallModules')->display(); ?>
<?php $this->getWidget(array('end' => '1'), null, 'modules_install_form')->display(); ?>
