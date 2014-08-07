<div class="step-items">
  <ul>
    <li class="item-store"><?php echo $this->t('Specify your _store information_',array('URL'=>$this->buildURL('settings','',array('page'=>'Company')))); ?></li>
    <li class="item-products"><?php echo $this->t('Add your _products_',array('URL'=>$this->buildURL('product_list'))); ?></li>
    <li class="item-taxes"><?php echo $this->t('Setup _address zones_ and _taxes_',array('URL1'=>$this->buildURL('zones'),'URL2'=>$this->buildURL('tax_classes'))); ?></li>
    <li class="item-shipping"><?php echo $this->t('Configure _shipping methods_',array('URL'=>$this->buildURL('shipping_methods'))); ?></li>
    <li class="item-payment"><?php echo $this->t('Choose _payment methods_',array('URL'=>$this->buildURL('payment_settings'))); ?></li>
    <?php $this->displayViewListContent('admin-welcome-items'); ?>
  </ul>
</div>
