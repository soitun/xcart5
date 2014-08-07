<?php if ($this->showXCNModuleNotice($this->get('module'))): ?><div class="note error xcn-module-notice" >
<span>
<?php echo $this->t('Module available editions 1',array('list'=>$this->getEditions($this->get('module')),'URL'=>$this->getPurchaseURL())); ?>
  <?php $this->getWidget(array('label' => 'Activate existing key'), '\XLite\View\Button\ActivateKey')->display(); ?>
</span>
</div><?php endif; ?>
