<div class="payment-conf">

<?php if ($this->hasPaymentModules()){?>

  <?php if ($this->hasGateways()): ?><div  class="box gateways">
    <h2><?php echo func_htmlspecialchars($this->t('Accepting credit card online')); ?></h2>
    <div class="content">

      <?php if ($this->hasAddedGateways()){?>

        <?php $this->getWidget(array(), 'XLite\View\ItemsList\Payment\Method\Admin\Gateways')->display(); ?>
        <?php $this->getWidget(array('paymentType' => \XLite\Model\Payment\Method::TYPE_ALLINONE, 'style' => 'add-method'), 'XLite\View\Button\Payment\AddMethod')->display(); ?>
        <?php if ($this->countNonAddedGateways()): ?><div  class="counter"><?php echo func_htmlspecialchars($this->t('X methods available',array('count'=>$this->countNonAddedGateways()))); ?></div><?php endif; ?>

      <?php }else{ ?>

        <p><?php echo func_htmlspecialchars($this->t('Use a merchant account from your financial institution or choose a bundled payment solution to accept credit cards and other methods of payment on your website.')); ?></p>
        <?php $this->getWidget(array('paymentType' => \XLite\Model\Payment\Method::TYPE_ALLINONE, 'style' => 'action'), 'XLite\View\Button\Payment\AddMethod')->display(); ?>

      <?php }?>

    </div>
  </div><?php endif; ?>

  <?php if ($this->hasAlternative()): ?><div  class="box alternative">
    <h2><?php echo func_htmlspecialchars($this->t('Alternative payment methods')); ?></h2>
    <div class="content">

      <?php if ($this->hasAddedAlternative()){?>

        <?php $this->getWidget(array(), 'XLite\View\ItemsList\Payment\Method\Admin\Alternative')->display(); ?>
        <?php $this->getWidget(array('paymentType' => \XLite\Model\Payment\Method::TYPE_ALTERNATIVE, 'style' => 'add-method'), 'XLite\View\Button\Payment\AddMethod')->display(); ?>
        <?php if ($this->countNonAddedAlternative()): ?><div  class="counter"><?php echo func_htmlspecialchars($this->t('X methods available',array('count'=>$this->countNonAddedAlternative()))); ?></div><?php endif; ?>

      <?php }else{ ?>

        <p><?php echo func_htmlspecialchars($this->t('Give buyers a way to pay by adding an alternative payment method.')); ?></p>
        <?php $this->getWidget(array('paymentType' => \XLite\Model\Payment\Method::TYPE_ALTERNATIVE, 'style' => 'action'), 'XLite\View\Button\Payment\AddMethod')->display(); ?>

      <?php }?>

    </div>
  </div><?php endif; ?>

<?php }else{ ?>

  <div class="box no-payment-modules">
    <h2><?php echo func_htmlspecialchars($this->t('No payment modules installed')); ?></h2>
    <div class="content">
      <p><?php echo func_htmlspecialchars($this->t('In order to accept credit cards payments you should install the necessary payment module from our Marketplace.')); ?></p>
      <?php $this->getWidget(array('label' => $this->t('Go to Marketplace'), 'location' => $this->buildURL('addons_list_marketplace','',array('tag'=>'Payment processing')), 'style' => 'action'), 'XLite\View\Button\Link')->display(); ?>
    </div>
  </div>

  <?php }?>

  <div class="right-panel-payment-modules">

    <?php if ($this->hasPaymentModules()): ?><div  class="subbox marketplace">
      <h2><?php echo func_htmlspecialchars($this->t('Need more payment methods?')); ?></h2>

      <img src="skins/admin/en/images/payment_logos.gif" alt="<?php echo func_htmlspecialchars($this->t('Payment methods')); ?>" class="payment-logos" /><br />

      <?php $this->getWidget(array('label' => $this->t('Find in Marketplace'), 'location' => $this->buildURL('addons_list_marketplace','',array('tag'=>'Payment processing')), 'style' => 'regular-main-button'), 'XLite\View\Button\Link')->display(); ?>
    </div><?php endif; ?>

    <div class="subbox watch-video">
      <h2><?php echo func_htmlspecialchars($this->t('Understanding Online Payments')); ?></h2>
      <p><?php echo func_htmlspecialchars($this->t('Watch this short video and learn the basics of how online payment processing works')); ?></p>
      <?php $this->getWidget(array('label' => $this->t('Watch video'), 'location' => $this->getVideoURL(), 'style' => 'watch-video', 'blank' => 'true'), 'XLite\View\Button\Link')->display(); ?>
    </div>
    
  </div>

  <div class="box offline-methods">
  <h2><?php echo func_htmlspecialchars($this->t('Offline methods')); ?></h2>
  <div class="content">
    <?php $this->getWidget(array(), 'XLite\View\ItemsList\Payment\Method\Admin\OfflineModules')->display(); ?>
    <?php $this->getWidget(array(), 'XLite\View\ItemsList\Payment\Method\Admin\Offline')->display(); ?>
    <?php $this->getWidget(array('paymentType' => \XLite\Model\Payment\Method::TYPE_OFFLINE, 'style' => 'add-method'), 'XLite\View\Button\Payment\AddMethod')->display(); ?>
  </div>
</div>

</div>
