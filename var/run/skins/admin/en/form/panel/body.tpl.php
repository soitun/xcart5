<?php $button = isset($this->button) ? $this->button : null; $_foreach_var = $this->getButtons(); if (isset($_foreach_var)) { $this->buttonArraySize=count($_foreach_var); $this->buttonArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->i => $this->button){ $this->buttonArrayPointer++; ?><div  class="<?php echo func_htmlspecialchars($this->getCellClass($this->get('buttonArrayPointer'),$this->get('i'),$this->get('button'))); ?>" ><?php echo $this->get('button')->display(); ?></div>
<?php } $this->button = $button; ?>