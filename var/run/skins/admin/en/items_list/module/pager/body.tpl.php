<div class="addons-pager-found-title"><?php echo func_htmlspecialchars($this->getPagerTitle()); ?></div>

<?php if ($this->isPagesListVisible()): ?><div class="addons-pager-list-wrapper" >
  <ul class="pagination grid-list addons-pager-list">
    <?php $page = isset($this->page) ? $this->page : null; $_foreach_var = $this->getPages(); if (isset($_foreach_var)) { $this->pageArraySize=count($_foreach_var); $this->pageArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->page){ $this->pageArrayPointer++; ?><li  class="<?php echo func_htmlspecialchars($this->getComplex('page.classes')); ?>">
      <?php if ($this->getComplex('page.href')): ?><a  href="<?php echo func_htmlspecialchars($this->getComplex('page.href')); ?>" class="<?php echo func_htmlspecialchars($this->getComplex('page.page')); ?>" title="<?php echo func_htmlspecialchars($this->t($this->getComplex('page.title'))); ?>" data-text="<?php echo func_htmlspecialchars($this->t($this->getComplex('page.text'))); ?>"><?php echo $this->t($this->getComplex('page.text')); ?></a><?php endif; ?>
      <?php if (!($this->getComplex('page.href'))): ?><span  class="<?php echo func_htmlspecialchars($this->getComplex('page.page')); ?>" title="<?php echo func_htmlspecialchars($this->t($this->getComplex('page.title'))); ?>"><?php echo $this->t($this->getComplex('page.text')); ?></span><?php endif; ?>
    </li>
<?php } $this->page = $page; ?>
  </ul>
</div><?php endif; ?>

<div class="addons-pager-buttons">
<?php $this->displayInheritedViewListContent('buttons'); ?>
</div>

<div class="addons-pager-bottom-title"><?php echo $this->getPagerBottomTitle(); ?></div>

<?php $this->displayInheritedViewListContent('tail'); ?>
