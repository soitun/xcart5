<div class="<?php echo func_htmlspecialchars($this->getContainerClass()); ?>">
  <?php if ($this->getHead()): ?><h2 ><?php echo func_htmlspecialchars($this->t($this->getHead())); ?></h2><?php endif; ?>
  <div class="content">
    <ul>
      <?php $_foreach_var = $this->getItems(); if (isset($_foreach_var)) { $this->itemArraySize=count($_foreach_var); $this->itemArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->item){ $this->itemArrayPointer++; ?>
        <li class="<?php echo func_htmlspecialchars($this->getItemClass($this->get('item'))); ?>"><a href="<?php echo func_htmlspecialchars($this->getComplex('item.link')); ?>"><?php echo func_htmlspecialchars($this->getComplex('item.title')); ?></a></li>
      <?php }?>
    </ul>
  </div>
</div>
