<h1><?php echo func_htmlspecialchars($this->t($this->getTitle())); ?></h1>

<div class="tabbed-content-wrapper">
  <div class="tabs-container">
    <?php if ($this->isTabsNavigationVisible()): ?><div class="page-tabs clearfix" >

      <ul>
        <?php $tabPage = isset($this->tabPage) ? $this->tabPage : null; $_foreach_var = $this->getTabs(); if (isset($_foreach_var)) { $this->tabPageArraySize=count($_foreach_var); $this->tabPageArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->tabPage){ $this->tabPageArrayPointer++; ?><li  class="tab<?php if ($this->getComplex('tabPage.selected')){?>-current<?php }?>">
          <a href="<?php echo $this->getComplex('tabPage.url'); ?>"><?php echo func_htmlspecialchars($this->t($this->getComplex('tabPage.title'))); ?></a>
        </li>
<?php } $this->tabPage = $tabPage; ?>
        <?php $this->displayViewListContent('tabs.items'); ?>
      </ul>
    </div><?php endif; ?>
    <div class="clear"></div>

    <div class="tab-content">
      <?php if ($this->isTemplateOnlyTab()):
  $this->display($this->getTabTemplate());
endif; ?>
      <?php if ($this->isWidgetOnlyTab()):
  $this->getWidget(array(), $this->getTabWidget())->display();
endif; ?>
      <?php if ($this->isFullWidgetTab()):
  $this->getWidget(array('template' => $this->getTabTemplate()), $this->getTabWidget())->display();
endif; ?>
      <?php if ($this->isCommonTab()):
  $this->display($this->getPageTemplate());
endif; ?>
    </div>

  </div>
</div>
