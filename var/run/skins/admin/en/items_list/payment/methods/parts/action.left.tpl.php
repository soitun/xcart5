<div class="action left-action">
  <?php if ($this->canSwitch($this->get('method'))){?>
    <?php if ($this->get('method')->getWarningNote()){?>

      <?php if ($this->get('method')->isEnabled()){?>
        <div class="switch enabled"><img src="skins/admin/en/images/spacer.gif" alt="<?php echo func_htmlspecialchars($this->t('Enabled')); ?>" /></div>
      <?php }else{ ?>
        <div class="switch disabled" title="<?php echo func_htmlspecialchars($this->t('This payment method cannot be enabled until you configure it')); ?>"><img src="skins/admin/en/images/spacer.gif" alt="<?php echo func_htmlspecialchars($this->t('Disabled')); ?>" /></div>
      <?php }?>

    <?php }else{ ?>

      <?php if ($this->get('method')->isEnabled()){?>
        <div class="switch enabled"><a href="<?php echo func_htmlspecialchars($this->buildURL('payment_settings','disable',array('id'=>$this->get('method')->getMethodId()))); ?>"><img src="skins/admin/en/images/spacer.gif" alt="<?php echo func_htmlspecialchars($this->t('Disable')); ?>" /></a></div>
      <?php }else{ ?>
        <div class="switch disabled"><a href="<?php echo func_htmlspecialchars($this->buildURL('payment_settings','enable',array('id'=>$this->get('method')->getMethodId()))); ?>"><img src="skins/admin/en/images/spacer.gif" alt="<?php echo func_htmlspecialchars($this->t('Enable')); ?>" /></a></div>
      <?php }?>

    <?php }?>

  <?php }else{ ?>

    <?php if ($this->canEnable($this->get('method'))){?>
      <div class="switch enabled" title="<?php echo func_htmlspecialchars($this->get('method')->getForcedEnabledNote()); ?>"><img src="skins/admin/en/images/spacer.gif" alt="" /></div>
    <?php }else{ ?>
      <div class="switch disabled" title="<?php echo func_htmlspecialchars($this->get('method')->getForbidEnableNote()); ?>"><img src="skins/admin/en/images/spacer.gif" alt="" /></div>
    <?php }?>

  <?php }?>

  <img src="skins/admin/en/images/spacer.gif" class="separator" alt="" />
</div>
