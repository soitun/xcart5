/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * TinyMCE-based textarea controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

var configTinyMCE;

jQuery(function() {

  // Retrive configuration for the tinyMCE object from the PHP settings
  configTinyMCE = core.getCommentedData(jQuery('textarea.tinymce').eq(0).parent().eq(0));

  tinymce.suffix = '.min';
  tinymce.base = 'skins/admin/en/modules/CDev/TinyMCE/js/tinymce';

  tinymce.init({
    selector: "textarea.tinymce",
    content_css: configTinyMCE.contentCSS,
    resize: "both",
    relative_urls: false,
    subfolder: "",
    theme: "modern",
    width: 780,
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "template paste textcolor"
    ],
    toolbar1: "insertfile undo redo | styleselect formatselect fontselect fontsizeselect | bold italic",
    toolbar2: "alignleft aligncenter alignright alignjustify | forecolor backcolor | bullist numlist outdent indent | link image | print preview media",
    image_advtab: true
  });
});
