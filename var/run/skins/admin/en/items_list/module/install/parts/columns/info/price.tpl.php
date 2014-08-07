<?php if ($this->showPrice($this->get('module'))): ?><div  class="price">
  <?php if (!($this->isFree($this->get('module')))): ?><div  class="paid">
    <span class="currency"><?php echo func_htmlspecialchars($this->formatPrice($this->get('module')->getPrice(),$this->get('module')->getCurrency())); ?></span>
    <?php if ($this->isPurchased($this->get('module'))): ?><span  class="purchased">(<?php echo func_htmlspecialchars($this->t('Purchased')); ?>)</span><?php endif; ?>
  </div><?php endif; ?>
</div><?php endif; ?>
