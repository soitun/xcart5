<?php if ($this->areUpdatesAvailable()): ?><li  class="updates-note">
  <a href="<?php echo func_htmlspecialchars($this->buildURL('upgrade','',array('mode'=>'install_updates'))); ?>" title="<?php echo func_htmlspecialchars($this->t('Updates for the X-Cart core and/or installed modules are available')); ?>">
    <?php echo func_htmlspecialchars($this->t('Updates are available')); ?>
  </a>
</li><?php endif; ?>
