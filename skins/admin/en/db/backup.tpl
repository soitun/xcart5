{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Database backup tab template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="backup-notice-content">
  {t(#Use this section to back up the database of your online store. Please note that the database backup procedure can take up to several minutes.#)}
</div>
<div class="backup-notice-content">
  {t(#You can choose if to download your database data#):h}
</div>
<div class="db-backup-form">
  <widget class="\XLite\View\Form\DbBackup" name="db_backup" />
    <widget class="\XLite\View\Button\Submit" style="download-sql" label="{t(#Download SQL file#)}" />

{*  <widget class="\XLite\View\Tooltip" id="download-sql-help" text="{t(##)}" isImageTag=true className="help-icon" />
*}
    <widget IF="isFileWritable()" class="\XLite\View\Button\Regular" style="create-sql-file" label="{t(#Create SQL file#)}" action="backup_write_to_file" />
    <widget IF="isFileWritable()" class="\XLite\View\Tooltip" id="create-sql-file-help" text="{t(#If you choose to create SQL file, you will be able to download the file from the server later and after that delete it from the server by clicking on the "Delete SQL file" button.#)}" isImageTag=true className="help-icon" />

    <div class="clear"></div>
    
    <widget IF="isFileExists()" class="\XLite\View\Button\Regular" style="delete-sql-file" label="{t(#Delete SQL file#)}" action="delete" />

{*  <widget IF="isFileExists()" class="\XLite\View\Tooltip" id="delete-sql-file-help" text="{t(##)}" isImageTag=true className="help-icon" />
*}

    <p IF="!isFileWritable()" class="backup-warning-content">
      {t(#You cannot save database data to a file on the web server ('var/backup/sqldump.sql.php').#)}
      <span IF="!isDirExists()" class="no-backup-dir">{t(#The directory 'var/backup/' does not exist or is not writable.#)}</span>
      <span IF="isDirExists()" class="backup-file-non-writable">{t(#The directory 'var/backup/' does not exist or is not writable.#)}</span>    
    </p>
  <widget name="db_backup" end />
</div>