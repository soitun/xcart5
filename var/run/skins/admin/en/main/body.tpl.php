<div class="<?php echo func_htmlspecialchars($this->getBoxClass()); ?>">
  <div class="inner-box">
    <?php if ($this->isRootAccess()): ?><?php $this->displayViewListContent('dashboard-center.welcome', array('IF' => 'isRootAccess()')); ?><?php endif; ?>
    <?php if (!($this->isRootAccess())): ?><?php $this->displayViewListContent('dashboard-center.welcome.non-root', array('IF' => '!isRootAccess()')); ?><?php endif; ?>
  </div>
</div>
