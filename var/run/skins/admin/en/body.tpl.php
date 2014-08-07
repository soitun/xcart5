<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo func_htmlspecialchars($this->getComplex('currentLanguage.code')); ?>" version="XHTML+RDFa 1.0" dir="<?php if ($this->getComplex('currentLanguage.r2l')){?>rtl<?php }else{ ?>ltr<?php }?>"
  xmlns:content="http://purl.org/rss/1.0/modules/content/"
  xmlns:dc="http://purl.org/dc/terms/"
  xmlns:foaf="http://xmlns.com/foaf/0.1/"
  xmlns:og="http://ogp.me/ns#"
  xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
  xmlns:sioc="http://rdfs.org/sioc/ns#"
  xmlns:sioct="http://rdfs.org/sioc/types#"
  xmlns:skos="http://www.w3.org/2004/02/skos/core#"
  xmlns:xsd="http://www.w3.org/2001/XMLSchema#">
<?php $this->getWidget(array(), '\XLite\View\Header')->display(); ?>
<body class="<?php echo func_htmlspecialchars($this->getBodyClass()); ?>">
<?php $this->displayViewListContent('body'); ?>
</body>
</html>
