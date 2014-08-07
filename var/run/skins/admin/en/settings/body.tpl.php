<div class="settings general-settings settings-<?php echo func_htmlspecialchars($this->get('page')); ?>">
  <?php if ($this->get('target')=='module'):
  $this->getWidget(array('useBodyTemplate' => '1'), '\XLite\View\Model\ModuleSettings')->display();
endif; ?>
  <?php if (!($this->get('target')=='module')):
  $this->getWidget(array('useBodyTemplate' => '1'), '\XLite\View\Model\Settings')->display();
endif; ?>
</div>
