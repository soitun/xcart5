<div class="add-payment-box payment-type-<?php echo func_htmlspecialchars($this->getPaymentType()); ?>">

  <?php if (\XLite\Model\Payment\Method::TYPE_ALLINONE==$this->getPaymentType()): ?><ul  class="tabs-container">

    <li class="headers">
      <ul>
        <li class="header all-in-one-solutions selected">
          <div class="header-wrapper">
            <div class="main-head"><?php echo func_htmlspecialchars($this->t('All-in-one solutions')); ?></div>
            <div class="small-head"><?php echo func_htmlspecialchars($this->t('No merchant account required')); ?></div>
          </div>
        </li>
        <li class="header payment-gateways">
          <div class="header-wrapper">
            <div class="main-head"><?php echo func_htmlspecialchars($this->t('Payment gateways')); ?></div>
            <div class="small-head"><?php echo func_htmlspecialchars($this->t('Requires registered merchant account')); ?></div>
          </div>
        </li>
      </ul>
    </li>

    <li class="body">
      <ul>
        <li class="body-item all-in-one-solutions selected">
          <div class="body-box">
            <div class="everything-you-need"><?php echo func_htmlspecialchars($this->t('Everything you need')); ?></div>
            <div class="description"><?php echo func_htmlspecialchars($this->t('Choose from a variety of bundled payment solutions to accept credit cards and other methods of payment on your website')); ?></div>

            <?php if ($this->isDisplayRequired(array('payment_method_selection'))):
  $this->getWidget(array('paymentType' => \XLite\Model\Payment\Method::TYPE_ALLINONE), '\XLite\View\Payment\MethodsPopupList')->display();
endif; ?>

            <?php if ($this->isDisplayRequired(array('payment_method_selection'))):
  $this->getWidget(array(), '\XLite\View\Payment\MarketplaceBlock')->display();
endif; ?>
          </div>
        </li>

        <li class="body-item payment-gateways">
          <div class="body-box">
            <div class="everything-you-need"><?php echo func_htmlspecialchars($this->t('Join forces with your bank')); ?></div>
            <div class="description"><?php echo func_htmlspecialchars($this->t('Use a merchant account from your financial institution to accept online payments')); ?></div>

            <?php if ($this->isDisplayRequired(array('payment_method_selection'))):
  $this->getWidget(array('paymentType' => \XLite\Model\Payment\Method::TYPE_CC_GATEWAY), '\XLite\View\Payment\MethodsPopupList')->display();
endif; ?>

            <?php if ($this->isDisplayRequired(array('payment_method_selection'))):
  $this->getWidget(array(), '\XLite\View\Payment\MarketplaceBlock')->display();
endif; ?>
          </div>
        </li>
      </ul>
    </li>

  </ul><?php endif; ?>

  <?php if (\XLite\Model\Payment\Method::TYPE_ALTERNATIVE==$this->getPaymentType()): ?><ul  class="tabs-container alternative-methods">
    <li class="alternative selected tab">
      <ul>
        <li class="body">
          <div class="body-box">
            <div class="everything-you-need"><?php echo func_htmlspecialchars($this->t('Quick and easy setup')); ?></div>
            <div class="description"><?php echo func_htmlspecialchars($this->t('Give buyers another way to pay by adding an alternative payment method')); ?></div>

            <?php if ($this->isDisplayRequired(array('payment_method_selection'))):
  $this->getWidget(array('paymentType' => \XLite\Model\Payment\Method::TYPE_ALTERNATIVE), '\XLite\View\Payment\MethodsPopupList')->display();
endif; ?>

            <?php if ($this->isDisplayRequired(array('payment_method_selection'))):
  $this->getWidget(array(), '\XLite\View\Payment\MarketplaceBlock')->display();
endif; ?>
          </div>
        </li>
      </ul>
    </li>
  </ul><?php endif; ?>

  <?php if (\XLite\Model\Payment\Method::TYPE_OFFLINE==$this->getPaymentType()): ?><ul  class="offline-methods tabs-container">
    <li class="offline selected tab">
      <ul>
        <li class="body">
          <?php $this->displayViewListContent('payment.method.add.offline'); ?>
        </li>
      </ul>
    </li>
  </ul><?php endif; ?>

</div>
