<button type="button" class="<?php echo func_htmlspecialchars($this->getClass()); ?>">
  <?php echo func_htmlspecialchars($this->displayCommentedData($this->getURLParams())); ?>
  <span><?php echo func_htmlspecialchars($this->t($this->getButtonContent())); ?></span>
  <?php $_foreach_var = $this->getModulesToInstall(); if (isset($_foreach_var)) { $this->valArraySize=count($_foreach_var); $this->valArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->id => $this->val){ $this->valArrayPointer++; ?>
  <input type="hidden" name="moduleIds[]" value="<?php echo func_htmlspecialchars($this->get('val')); ?>" id="moduleids_<?php echo func_htmlspecialchars($this->get('val')); ?>" />
  <?php }?>
</button>
