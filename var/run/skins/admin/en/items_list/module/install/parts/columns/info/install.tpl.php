<?php if ($this->canInstall($this->get('module'))): ?><div class="install-section" >
  <div class="install">
    <?php $this->getWidget(array('moduleID' => $this->get('module')->getModuleID()), '\XLite\View\ModulesManager\Action\SelectToInstall')->display(); ?>
  </div>
</div><?php endif; ?>
