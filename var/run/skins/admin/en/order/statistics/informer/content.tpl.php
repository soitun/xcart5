<div class="orders-stats">
  <div class="tab-content-title"><?php echo func_htmlspecialchars($this->t('Accepted orders')); ?></div>
  <?php if (!($this->isEmptyStats())): ?><div class="value" ><?php echo func_htmlspecialchars($this->getComplex('tab.orders.value')); ?><span class="<?php echo func_htmlspecialchars($this->getDeltaType($this->get('tab'),'orders')); ?>"></span></div><?php endif; ?>
  <?php if ($this->isEmptyStats()): ?><div class="value" >&mdash;</div><?php endif; ?>
  <?php if ($this->isDisplayPrevValue($this->get('tab'))): ?><div class="prev" ><?php echo func_htmlspecialchars($this->getPrevValue($this->get('tab'),'orders')); ?></div><?php endif; ?>
</div>

<div class="revenue-stats">
  <div class="tab-content-title"><?php echo func_htmlspecialchars($this->t('Revenue')); ?></div>
  <div class="value"><?php echo func_htmlspecialchars($this->formatValue($this->getComplex('tab.revenue.value'))); ?><span class="<?php echo func_htmlspecialchars($this->getDeltaType($this->get('tab'),'revenue')); ?>"></span></div>
  <?php if ($this->isDisplayPrevValue($this->get('tab'))): ?><div class="prev" ><?php echo func_htmlspecialchars($this->getPrevValue($this->get('tab'),'revenue')); ?></div><?php endif; ?>
</div>

<?php if ($this->isLifetimeTab($this->get('tab'))): ?><div class="lifetime-stats" ><?php echo func_htmlspecialchars($this->t('Sale statistics from the opening of the store')); ?></div><?php endif; ?>
<?php if ($this->isEmptyStats()): ?><div class="no-orders" ><?php echo func_htmlspecialchars($this->t('No order have been placed yet')); ?></div><?php endif; ?>
