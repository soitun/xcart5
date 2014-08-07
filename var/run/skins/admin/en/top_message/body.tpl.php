<div id="status-messages" <?php if ($this->isHidden()){?> style="display: none;"<?php }?>>

  <a href="#" class="close-message" title="<?php echo func_htmlspecialchars($this->t('Close')); ?>"><img src="<?php echo func_htmlspecialchars($this->getPath()); ?>/spacer3.gif" alt="<?php echo func_htmlspecialchars($this->t('Close')); ?>" /></a>

  <ul>
    <?php $data = isset($this->data) ? $this->data : null; $_foreach_var = $this->getTopMessages(); if (isset($_foreach_var)) { $this->dataArraySize=count($_foreach_var); $this->dataArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->data){ $this->dataArrayPointer++; ?><li  class="<?php echo func_htmlspecialchars($this->getType($this->get('data'))); ?>">
      <?php if ($this->getPrefix($this->get('data'))): ?><em ><?php echo func_htmlspecialchars($this->getPrefix($this->get('data'))); ?></em><?php endif; ?><?php echo $this->getText($this->get('data')); ?>
    </li>
<?php } $this->data = $data; ?>
  </ul>

</div>
