<div class="model-form-buttons">
  <?php $button = isset($this->button) ? $this->button : null; $_foreach_var = $this->getFormButtons(); if (isset($_foreach_var)) { $this->buttonArraySize=count($_foreach_var); $this->buttonArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->name => $this->button){ $this->buttonArrayPointer++; ?><div class="button <?php echo func_htmlspecialchars($this->get('name')); ?>" ><?php echo func_htmlspecialchars($this->get('button')->display()); ?></div>
<?php } $this->button = $button; ?>
</div>
