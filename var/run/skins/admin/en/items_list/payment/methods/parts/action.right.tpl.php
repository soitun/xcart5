<?php if ($this->hasRightActions($this->get('method'))): ?><div  class="action right-action">

  <img src="skins/admin/en/images/spacer.gif" class="separator" alt="" />

  <?php if ($this->canRemoveMethod($this->get('method'))): ?><div  class="remove"><a href="<?php echo func_htmlspecialchars($this->buildURL('payment_settings','remove',array('id'=>$this->get('method')->getMethodId()))); ?>" title="<?php echo func_htmlspecialchars($this->t('Remove')); ?>"><img src="skins/admin/en/images/spacer.gif" alt="" /></a></div><?php endif; ?>
  <?php if ($this->get('method')->getWarningNote()){?>
    <?php if ($this->canRemoveMethod($this->get('method'))): ?><img  src="skins/admin/en/images/spacer.gif" class="subseparator" alt="" /><?php endif; ?>
    <div class="warning"><a href="<?php echo func_htmlspecialchars($this->get('method')->getConfigurationURL()); ?>"><img src="skins/admin/en/images/spacer.gif" alt="<?php echo func_htmlspecialchars($this->get('method')->getWarningNote()); ?>" /></a></div>
  <?php }elseif (!($this->get('method')->isCurrencyApplicable())){?>
    <?php if ($this->canRemoveMethod($this->get('method'))): ?><img  src="skins/admin/en/images/spacer.gif" class="subseparator" alt="" /><?php endif; ?>
    <div class="warning"><a href="<?php echo func_htmlspecialchars($this->buildURL('currency')); ?>"><img src="skins/admin/en/images/spacer.gif" alt="<?php echo func_htmlspecialchars($this->t('This method does not support the current store currency and is not available for customers')); ?>" /></a></div>
  <?php }elseif ($this->get('method')->isTestMode()){?>
    <?php if ($this->canRemoveMethod($this->get('method'))): ?><img  src="skins/admin/en/images/spacer.gif" class="subseparator" alt="" /><?php endif; ?>
    <div class="test-mode"><a href="<?php echo func_htmlspecialchars($this->get('method')->getConfigurationURL()); ?>"><img src="skins/admin/en/images/spacer.gif" alt="<?php echo func_htmlspecialchars($this->t('This method is in test mode')); ?>" /></a></div>
  <?php }elseif ($this->get('method')->isConfigurable()){?>
    <?php if ($this->canRemoveMethod($this->get('method'))): ?><img  src="skins/admin/en/images/spacer.gif" class="subseparator" alt="" /><?php endif; ?>
    <div class="configure"><a href="<?php echo func_htmlspecialchars($this->get('method')->getConfigurationURL()); ?>" title="<?php echo func_htmlspecialchars($this->t('Configure')); ?>"><img src="skins/admin/en/images/spacer.gif" alt="" /></a></div>
  <?php }?>
</div><?php endif; ?>
