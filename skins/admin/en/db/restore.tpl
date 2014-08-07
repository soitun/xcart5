{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Database restore tab template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<p class="restore-notice-content">
  {t(#Use this section to restore the database of your online store. Please note that the database restoration procedure can take up to several minutes#)}
</p>

<p class="restore-notice-content">        
{t(#Warning: The restoration procedure is irreversible and erases all the data tables from the store database. It is highly recommended that you back up your current database before restoring one of the previous states from a back-up.#)}
</p>

<div class="db-restore-form">
  <widget class="\XLite\View\Form\DbRestore" name="db_restore" />

    <input class="input-file" type="file" name="userfile" />
    <div class="clear"></div>

    <widget class="\XLite\View\Button\Submit" style="upload-restore" label="Upload and restore" />

    <widget class="\XLite\View\Tooltip" id="upload-restore-help" text="{t(#You can upload the database data directly from your local computer#,_ARRAY_(#N#^getUploadMaxFilesize())):h}" isImageTag=true className="help-icon" />
    <widget IF="isFileExists()" class="\XLite\View\Button\Regular" style="restore-from-server" action="restore_from_local_file" label="Restore from server" />
    
    <widget IF="isFileExists()" class="\XLite\View\Tooltip" id="restore-from-server-help" text="{t(#Alternatively, upload file sqldump.sql.php to the var/backup/ sub-directory click on the "Restore from server" button#)}" isImageTag=true className="help-icon" />
  
  <widget name="db_restore" end />
</div>