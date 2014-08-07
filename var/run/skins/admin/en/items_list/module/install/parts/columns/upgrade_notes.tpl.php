<?php if ($this->isModuleUpdateAvailable($this->get('module'))): ?><div  class="note version upgrade">
  <?php echo func_htmlspecialchars($this->t('Installed version')); ?>:&nbsp;<?php echo func_htmlspecialchars($this->getModuleVersion($this->getModuleInstalled($this->get('module')))); ?>&nbsp;(<?php echo func_htmlspecialchars($this->t('outdated')); ?>)<br />
  <a href="<?php echo func_htmlspecialchars($this->buildURL('upgrade','',array('mode'=>'install_updates'))); ?>"><?php echo func_htmlspecialchars($this->t('Update module')); ?></a>
</div><?php endif; ?>
