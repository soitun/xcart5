<span class="input-field-wrapper <?php echo func_htmlspecialchars($this->getWrapperClass()); ?>">
  <?php echo func_htmlspecialchars($this->displayCommentedData($this->getCommentedData())); ?>
  <input type="hidden" name="<?php echo func_htmlspecialchars($this->getName()); ?>" value="" />
  <input<?php echo $this->getAttributesCode(); ?> />
</span>
