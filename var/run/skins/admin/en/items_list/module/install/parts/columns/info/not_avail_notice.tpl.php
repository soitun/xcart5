<?php if ($this->showNotAvailModuleNotice($this->get('module'))): ?><div class="note error xcn-module-notice" >
<?php echo $this->t('This module is available for X-Cart hosted stores only.',array('url'=>$this->getMoreInfoURL())); ?>
</div><?php endif; ?>
