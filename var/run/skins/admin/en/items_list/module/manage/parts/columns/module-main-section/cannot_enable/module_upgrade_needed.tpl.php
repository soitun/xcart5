<?php if ($this->isModuleUpgradeNeeded($this->get('module'))): ?><div  class="note version error">
  <?php $this->displayNestedViewListContent('module_upgrade_needed', array('module' => $this->get('module'))); ?>
</div><?php endif; ?>
