<?php if ($this->isCoreUpgradeAvailable()&&!($this->areUpdatesAvailable())): ?><li  class="upgrade-note">
  <?php $this->getWidget(array(), '\XLite\View\Upgrade\SelectCoreVersion\Link')->display(); ?>
</li><?php endif; ?>
