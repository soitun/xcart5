<?php if ($this->isPagesListVisible()): ?><div class="pagination-wrapper" >
  <ul class="pagination">
    <?php $page = isset($this->page) ? $this->page : null; $_foreach_var = $this->getPages(); if (isset($_foreach_var)) { $this->pageArraySize=count($_foreach_var); $this->pageArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->page){ $this->pageArrayPointer++; ?><li  class="<?php echo func_htmlspecialchars($this->getComplex('page.classes')); ?>">
      <?php if ($this->getComplex('page.href')): ?><a  href="<?php echo func_htmlspecialchars($this->getComplex('page.href')); ?>" data-pageId="<?php echo func_htmlspecialchars($this->getComplex('page.num')); ?>"><?php echo $this->t($this->getComplex('page.text')); ?></a><?php endif; ?>
      <?php if (!($this->getComplex('page.href'))): ?><span ><?php echo $this->t($this->getComplex('page.text')); ?></span><?php endif; ?>
    </li>
<?php } $this->page = $page; ?>
  </ul>
</div><?php endif; ?>
