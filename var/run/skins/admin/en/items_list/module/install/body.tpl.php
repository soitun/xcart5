<?php if ($this->get('promoBanner')): ?><a  href="<?php echo func_htmlspecialchars($this->getComplex('promoBanner.module_banner_url')); ?>">
 <img src="<?php echo func_htmlspecialchars($this->getComplex('promoBanner.banner_url')); ?>" class="promo-banner" />
</a><?php endif; ?>

<table cellspacing="0" cellpadding="0" class="data-table items-list modules-list<?php if ($this->get('promoBanner')){?> module-list-has-promo-banner<?php }?>">

  <?php $module = isset($this->module) ? $this->module : null; $_foreach_var = $this->getPageData(); if (isset($_foreach_var)) { $this->moduleArraySize=count($_foreach_var); $this->moduleArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->idx => $this->module){ $this->moduleArrayPointer++; ?><tr  class="<?php echo func_htmlspecialchars($this->getModuleClassesCSS($this->get('module'))); ?>">
    <?php $this->displayInheritedViewListContent('columns', array('module' => $this->getModuleFromMarketplace($this->get('module')))); ?>
  </tr>
<?php } $this->module = $module; ?>

</table>
