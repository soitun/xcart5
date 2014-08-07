<?php if ($this->isCoreUpgradeNeeded($this->get('module'))): ?><div  class="note version error">
  <?php $this->displayNestedViewListContent('core_upgrade_needed', array('module' => $this->get('module'))); ?>
</div><?php endif; ?>
