<?php if (!($this->isEmptyStats())){?>

<div class="top-sellers">

  <?php $_foreach_var = $this->getOptions(); if (isset($_foreach_var)) { $this->nameArraySize=count($_foreach_var); $this->nameArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->period => $this->name){ $this->nameArrayPointer++; ?>
  <div id="period-<?php echo $this->get('period'); ?>" class="block-container" <?php if (!($this->isDefaultPeriod($this->get('period')))){?>style="display: none;"<?php }?>>
    <?php $this->getWidget(array('period' => $this->get('period'), 'products_limit' => '5'), '\XLite\View\ItemsList\Model\Product\Admin\TopSellers')->display(); ?>
  </div>
  <?php }?>

  <div class="period-box">
    <span class="label"><?php echo func_htmlspecialchars($this->t('For the period')); ?></span>
    <span class="field">
      <select name="period">
        <?php $_foreach_var = $this->getOptions(); if (isset($_foreach_var)) { $this->nameArraySize=count($_foreach_var); $this->nameArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->period => $this->name){ $this->nameArrayPointer++; ?>
        <option value="<?php echo func_htmlspecialchars($this->get('period')); ?>" <?php if ($this->isDefaultPeriod($this->get('period'))){?>selected="selected"<?php }?>><?php echo func_htmlspecialchars($this->t($this->get('name'))); ?></option>
        <?php }?>
      </select>
    </span>
  </div>

</div>

<?php }else{ ?>

<div class="empty-list"><?php echo func_htmlspecialchars($this->t('No products sold yet')); ?></div>

<?php }?>
