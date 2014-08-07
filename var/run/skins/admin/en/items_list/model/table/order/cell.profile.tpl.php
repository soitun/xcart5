<div class="profile-anonymous-icon">
  <?php if ($this->getComplex('entity.origProfile.anonymous')){?>
    <img src="skins/admin/en/images/anonymous.svg" alt="<?php echo func_htmlspecialchars($this->t('Anonymous Customer')); ?>" class="anonymous" title="<?php echo func_htmlspecialchars($this->t('Anonymous Customer')); ?>" />
  <?php }?>
</div>

<div class="profile-box">
  <?php if ($this->isProfileRemoved($this->get('entity'))){?>
    <span class="removed-profile-name"><?php echo func_htmlspecialchars($this->getColumnValue($this->get('column'),$this->get('entity'))); ?></span>
  <?php }else{ ?>
    <a href="<?php echo func_htmlspecialchars($this->buildURL('profile','',array('profile_id'=>$this->getComplex('entity.origProfile')->getProfileId()))); ?>"><?php echo func_htmlspecialchars($this->getColumnValue($this->get('column'),$this->get('entity'))); ?></a>
  <?php }?>
  <br />
  <span class="profile-email"><a href="mailto:<?php echo func_htmlspecialchars($this->getComplex('entity.profile')->getLogin()); ?>"><?php echo func_htmlspecialchars($this->getComplex('entity.profile')->getLogin()); ?></a></span>
  <?php if ($this->getComplex('column.noWrap')): ?><img  src="skins/admin/en/images/spacer.gif" class="right-fade" alt="" /><?php endif; ?>
</div>
