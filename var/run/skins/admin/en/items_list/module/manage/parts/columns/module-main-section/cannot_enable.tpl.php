<?php if ($this->hasErrors($this->get('module'))): ?><div >
  <?php $this->displayNestedViewListContent('cannot_enable', array('module' => $this->get('module'))); ?>
</div><?php endif; ?>
