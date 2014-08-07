<?php if ($this->getComplex('entity.inventory')->getEnabled()){?>
  <?php $this->display('form_field/inline/view.tpl'); ?>
<?php }else{ ?>
  &infin;
<?php }?>
