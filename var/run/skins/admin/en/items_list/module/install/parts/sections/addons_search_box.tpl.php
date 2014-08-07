<div class="addons-search-box">

  <?php $this->getWidget(array('formMethod' => 'GET', 'className' => 'search-form'), '\XLite\View\Form\Module\Install', 'install_search')->display(); ?>
  <input type="hidden" name="tag" value="<?php echo func_htmlspecialchars($this->getTagValue()); ?>" />
  <div class="substring">
    <?php $this->getWidget(array('fieldOnly' => 'true', 'fieldName' => 'substring', 'value' => $this->getSubstring(), 'defaultValue' => $this->t('Search for modules')), '\XLite\View\FormField\Input\Text')->display(); ?>
    <?php $this->getWidget(array('label' => ''), '\XLite\View\Button\Submit')->display(); ?>
  </div>
  <?php $this->getWidget(array('end' => '1'), null, 'install_search')->display(); ?>

</div>
