<ul class="payments-list">
  <?php $_foreach_var = $this->getPaymentMethods(); if (isset($_foreach_var)) { $this->entriesArraySize=count($_foreach_var); $this->entriesArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->family => $this->entries){ $this->entriesArrayPointer++; ?>
  <?php if ($this->entries[0]->getAdminIconURL()): ?><li  class="payment-method-icon"><img src="<?php echo func_htmlspecialchars($this->entries[0]->getAdminIconURL()); ?>" alt="<?php echo func_htmlspecialchars($this->entries[0]->getTitle()); ?>" /></li><?php endif; ?>
  <?php $payment = isset($this->payment) ? $this->payment : null; $_foreach_var = $this->get('entries'); if (isset($_foreach_var)) { $this->paymentArraySize=count($_foreach_var); $this->paymentArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->id => $this->payment){ $this->paymentArrayPointer++; ?><li >
    <ul class="payment-method-entry">
      <li class="title-row">
        <ul>
          <li class="title">
            <?php echo func_htmlspecialchars($this->get('payment')->getName()); ?>
          </li>
          <li class="button">
            <?php if (!($this->get('payment')->getAdded())):
  $this->getWidget(array('label' => $this->t('Choose'), 'location' => $this->buildURL('payment_settings','add',array('id'=>$this->get('payment')->getMethodId()))), 'XLite\View\Button\Link')->display();
endif; ?>
            <?php if ($this->get('payment')->getAdded()):
  $this->getWidget(array('label' => $this->t('Added'), 'jsCode' => 'void(0)', 'style' => 'disabled'), 'XLite\View\Button\Regular')->display();
endif; ?>
          </li>
          <li class="separator"></li>
        </ul>
        <div class="clearfix"></div>
      </li>
      <?php if ($this->get('payment')->getAdminDescription()): ?><li  class="description"><?php echo func_htmlspecialchars($this->get('payment')->getAdminDescription()); ?></li><?php endif; ?>
      <?php if ($this->get('payment')->getLinks()): ?><li  class="links">
        <ul>
          <?php $href = isset($this->href) ? $this->href : null; $_foreach_var = $this->get('payment')->getLinks(); if (isset($_foreach_var)) { $this->hrefArraySize=count($_foreach_var); $this->hrefArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->name => $this->href){ $this->hrefArrayPointer++; ?><li ><a href="<?php echo func_htmlspecialchars($this->get('href')); ?>"><?php echo func_htmlspecialchars($this->t($this->get('name'))); ?></a></li>
<?php } $this->href = $href; ?>
        </ul>
        <div class="clearfix"></div>
      </li><?php endif; ?>
    </ul>

  </li>
<?php } $this->payment = $payment; ?>
  <?php }?>
</ul>
