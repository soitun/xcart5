<?php $_foreach_var = $this->getFields(); if (isset($_foreach_var)) { $this->fArraySize=count($_foreach_var); $this->fArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->f){ $this->fArrayPointer++; ?>
  <div class="<?php echo func_htmlspecialchars($this->getFieldClassName($this->get('f'))); ?>">
    <?php echo func_htmlspecialchars($this->getComplex('f.widget')->display()); ?>
  </div>
<?php }?>
