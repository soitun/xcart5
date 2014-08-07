<?php if (!($this->getParam('fieldOnly'))){?>
  <div class="<?php echo func_htmlspecialchars($this->getLabelContainerClass()); ?>">
    <?php if ($this->getParam('useColon')): ?><label  for="<?php echo func_htmlspecialchars($this->getFieldId()); ?>" title="<?php echo $this->getFormattedLabel(); ?>"><?php echo func_htmlspecialchars($this->getFormattedLabel()); ?>:</label><?php endif; ?>
    <?php if (!($this->getParam('useColon'))): ?><label  for="<?php echo func_htmlspecialchars($this->getFieldId()); ?>" title="<?php echo $this->getFormattedLabel(); ?>"><?php echo func_htmlspecialchars($this->getFormattedLabel()); ?></label><?php endif; ?>
  </div>
  <?php if ($this->getParam('required')): ?><div  class="star">*</div><?php endif; ?>
  <?php if (!($this->getParam('required'))): ?><div  class="star">&nbsp;</div><?php endif; ?>
<?php }?>

<div class="<?php echo func_htmlspecialchars($this->getValueContainerClass()); ?>">
  <?php $this->display($this->getDir().'/'.$this->getFieldTemplate()); ?>
  <?php if ($this->getParam('help')):
  $this->getWidget(array('text' => $this->t($this->getParam('help')), 'isImageTag' => 'true', 'className' => 'help-icon'), '\XLite\View\Tooltip')->display();
endif; ?>
  <?php if ($this->getParam('comment')): ?><div  class="form-field-comment <?php echo func_htmlspecialchars($this->getFieldId()); ?>-comment"><?php echo $this->t($this->getParam('comment')); ?></div><?php endif; ?>
  <?php if ($this->getFormFieldJSData()){?><?php echo func_htmlspecialchars($this->displayCommentedData($this->getFormFieldJSData())); ?><?php }?>
  <?php if ($this->getInlineJSCode()): ?><script  type="text/javascript"><?php echo $this->getInlineJSCode(); ?></script><?php endif; ?>
</div>

<?php if (!($this->getParam('fieldOnly'))){?>
  <div class="clear"></div>
<?php }?>
