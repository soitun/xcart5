<?php if ($this->hasWrongDependencies($this->get('module'))): ?><div  class="note dependencies">
  <?php $this->displayNestedViewListContent('dependencies', array('module' => $this->get('module'))); ?>
</div><?php endif; ?>
