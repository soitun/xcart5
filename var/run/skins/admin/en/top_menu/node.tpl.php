<li class="menu-item <?php echo func_htmlspecialchars($this->getCSSClass()); ?>">
  <a href="<?php echo func_htmlspecialchars($this->getLink()); ?>"><?php echo $this->t($this->getTitle()); ?></a>
  <?php if ($this->hasChildren()): ?><div >
    <ul>
      <?php $_foreach_var = $this->getChildren(); if (isset($_foreach_var)) { $this->childArraySize=count($_foreach_var); $this->childArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->child){ $this->childArrayPointer++; ?>
        <?php echo func_htmlspecialchars($this->get('child')->display()); ?>
      <?php }?>
      <?php $this->displayViewListContent($this->getListName()); ?>
    </ul>
  </div><?php endif; ?>
</li>
