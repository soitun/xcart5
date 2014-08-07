<span
  id="product-sale-label-<?php echo func_htmlspecialchars($this->get('entity')->getProductId()); ?>"
  class="product-name-sale-label<?php if (!($this->participateSaleAdmin($this->get('entity')))){?> product-name-sale-label-disabled<?php }?>">
  <?php echo func_htmlspecialchars($this->t('sale')); ?>
</span>
