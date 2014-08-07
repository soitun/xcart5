<?php $_foreach_var = $this->getFields(); if (isset($_foreach_var)) { $this->fArraySize=count($_foreach_var); $this->fArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->f){ $this->fArrayPointer++; ?>
  <?php echo func_htmlspecialchars($this->getViewValue($this->get('f'))); ?>
<?php }?>
