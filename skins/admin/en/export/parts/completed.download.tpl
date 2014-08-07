{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Export completed section : files
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="export.completed.content", weight="100")
 *}

<div class="files std">
  <h3>{getBoxTitle()}</h3>
  <ul>
    <li FOREACH="getDownloadFiles(),path,file" class="file">
      <i class="icon-file-alt"></i>
      <a href="{buildURL(#export#,#download#,_ARRAY_(#path#^path))}">{file.getFilename()}</a>
      <span class="size">{formatSize(file.getSize())}</span>
    </li>
    <li class="sum">
      <div class="bracket" IF="isBracketVisible()"></div>
      <div class="icon"></div>

<div class="pack">
  <h4>{t(#Download all files in a single archive#)}</h4>
  <p>({t(#X, including images and file attachments#,_ARRAY_(#size#^formatSize(getPackedSize())))})</p>
  <ul>
    <li FOREACH="getAllowedPackTypes(),type">
      <widget class="XLite\View\Button\Link" location="{buildURL(#export#,#pack#,_ARRAY_(#type#^type))}" label="{type}" />
    </li>
  </ul>
</div>


    </li>
  </ul>
</div>
