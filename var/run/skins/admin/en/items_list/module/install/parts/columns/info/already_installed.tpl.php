<?php if ($this->isInstalled($this->get('module'))): ?><div  class="installed"><?php echo func_htmlspecialchars($this->t('Installed')); ?></div><?php endif; ?>
<?php if ($this->isInstalled($this->get('module'))): ?><div  class="view-module-in-list">
  <a href="<?php echo func_htmlspecialchars($this->getModulePageURL($this->get('module'))); ?>"><?php echo func_htmlspecialchars($this->t('View in list')); ?></a>
</div><?php endif; ?>
