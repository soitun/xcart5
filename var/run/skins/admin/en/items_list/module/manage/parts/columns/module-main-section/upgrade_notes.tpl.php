<?php if ($this->isModuleUpgradeAvailable($this->get('module'))): ?><div  class="note version upgrade">
  <?php echo func_htmlspecialchars($this->t('Version')); ?>:&nbsp;<?php echo func_htmlspecialchars($this->getModuleVersion($this->getModuleForUpgrade($this->get('module')))); ?>&nbsp;<?php echo func_htmlspecialchars($this->t('is available')); ?><br />
  <a href="<?php echo func_htmlspecialchars($this->buildURL('upgrade','',array('mode'=>'install_updates'))); ?>"><?php echo func_htmlspecialchars($this->t('Upgrade module')); ?></a>
</div><?php endif; ?>
