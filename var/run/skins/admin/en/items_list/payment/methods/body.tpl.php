<div class="<?php echo func_htmlspecialchars($this->getListCSSClasses()); ?>">

  <?php if ($this->getPageData()): ?><ul class="list" >
    <?php $_foreach_var = $this->getPageData(); if (isset($_foreach_var)) { $this->methodArraySize=count($_foreach_var); $this->methodArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->method){ $this->methodArrayPointer++; ?>
      <li class="<?php echo func_htmlspecialchars($this->getLineClass($this->get('method'))); ?>">
        <?php $this->displayViewListContent('payment.methods.list.line', array('method' => $this->get('method'))); ?>
      </li>
    <?php }?>
  </ul><?php endif; ?>

</div>
