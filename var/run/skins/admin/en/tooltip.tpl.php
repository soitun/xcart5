<div class="tooltip-main">
<?php if ($this->isImageTag()){?>
<i <?php echo $this->getAttributesCode(); ?>></i>
<?php }else{ ?>
<span <?php echo $this->getAttributesCode(); ?>><?php echo func_htmlspecialchars($this->getParam('caption')); ?></span>
<?php }?>
<div class="help-text" style="display: none;"><?php echo $this->getParam('text'); ?></div>
</div>
<div class="clear"></div>
