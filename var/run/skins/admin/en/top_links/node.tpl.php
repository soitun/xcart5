<li class="link-item <?php echo func_htmlspecialchars($this->getCSSClass()); ?>">
  <?php if ($this->getBlock()){?>
  <div class="link-item-block"><?php echo $this->getBlock(); ?></div>
  <?php }else{ ?>
  <a href="<?php echo func_htmlspecialchars($this->getLink()); ?>"<?php if ($this->hasChildren()){?> class="list"<?php }?><?php if ($this->getBlankPage()){?> target="_blank"<?php }?>>
    <?php if ($this->getIconClass()): ?><i  class="icon <?php echo func_htmlspecialchars($this->getIconClass()); ?>"></i><?php endif; ?>
    <span><?php echo $this->t($this->getTitle()); ?></span>
  </a>
  <?php }?>
  <?php if ($this->hasChildren()): ?><div class="children-block" >
    <ul>
    <?php $_foreach_var = $this->getChildren(); if (isset($_foreach_var)) { $this->childArraySize=count($_foreach_var); $this->childArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->child){ $this->childArrayPointer++; ?>
    <?php echo func_htmlspecialchars($this->get('child')->display()); ?>
    <?php }?>
    <?php $this->displayViewListContent($this->getListName()); ?>
    </ul>
  </div><?php endif; ?>
</li>
