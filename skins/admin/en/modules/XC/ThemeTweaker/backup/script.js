/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Script
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery().ready(
  function() {
    var codeBackup = jQuery('#code_backup');
    codeBackup.show();
    var editorBackup = CodeMirror.fromTextArea(document.getElementById('backup'), {readOnly: 'nocursor'});
    codeBackup.hide();

    jQuery('#code_backup_link a').click(
      function () {
        jQuery('#code_backup_link').hide();
        codeBackup.show();

        return false;
      }
    );

    jQuery('#code_backup a.hide').click(
      function () {
        jQuery('#code_backup_link').show();
        codeBackup.hide();

        return false;
      }
    );
  }
);
