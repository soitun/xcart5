{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Export completed section : large
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="export.completed.content", weight="200")
 *}

<div class="files large" IF="getDownloadLargeFiles()">
  <p>{t(#The following files are too large to be included in the archive#)}:</p>
  <ul>
    <li FOREACH="getDownloadLargeFiles(),path,file" class="file">
      <i class="icon-file-alt"></i>
      <a href="{buildURL(#export#,#download#,_ARRAY_(#path#^path))}">{file.getFilename()}</a>
      <span class="size">{formatSize(file.getSize())}</span>
    </li>
  </ul>
</div>
