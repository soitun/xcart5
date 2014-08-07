<script type="text/javascript">
var xliteConfig = {
  script:              '<?php echo $this->getScript(); ?>',
  language:            '<?php echo func_htmlspecialchars($this->get('currentLanguage')->getCode()); ?>',
  success_lng:         '<?php echo func_htmlspecialchars($this->t('Success')); ?>',
  base_url:            '<?php echo func_htmlspecialchars($this->getBaseShopURL()); ?>',
  form_id:             '<?php echo func_htmlspecialchars($this->getComplex('xlite.formId')); ?>',
  form_id_name:        '<?php echo func_htmlspecialchars(\XLite::FORM_ID); ?>',
  zeroClipboardSWFURL: '<?php echo func_htmlspecialchars($this->getZeroClipboardSWFUrl()); ?>'
};
</script>
