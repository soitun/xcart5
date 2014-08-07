<?php if ($this->isItemsPerPageVisible()): ?><div class="items-per-page-wrapper" >
  <span><?php echo func_htmlspecialchars($this->t('Items per page')); ?>:</span>
  <select name="itemsPerPage" class="page-length not-significant">
    <?php $range = isset($this->range) ? $this->range : null; $_foreach_var = $this->getItemsPerPageRanges(); if (isset($_foreach_var)) { $this->rangeArraySize=count($_foreach_var); $this->rangeArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->range){ $this->rangeArrayPointer++; ?><option  value="<?php echo func_htmlspecialchars($this->get('range')); ?>" <?php if ($this->isRangeSelected($this->get('range'))) { echo 'selected="selected"'; } ?>><?php echo func_htmlspecialchars($this->get('range')); ?></option>
<?php } $this->range = $range; ?>
  </select>
</div><?php endif; ?>
