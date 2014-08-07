{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * File uploader menu
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="file-uploader.menu", weight="30")
 *}

<li role="presentation" class="dropdown-header">{t(#Upload#)}</li>
<li role="presentation">
  <a role="menuitem" tabindex="-1" href="#" class="from-computer">
    <i class="button-icon fa fa-sign-out fa-rotate-270"></i>
    <span>{t(#From computer#)}</span>
  </a>
  <input type="file" name="uploaded-file"{if:hasMultipleSelector()} multiple="multiple"{end:} />
</li>
<li role="presentation">
  <a role="menuitem" tabindex="-1" href="#" class="via-url">
    <i class="button-icon fa fa-link"></i>
    <span>{t(#Via URL#)}</span>
  </a>
</li>
<div class="via-url-popup" data-title="{t(#Upload via URL#)}" data-multiple="{if:hasMultipleSelector()}1{end:}">
{if:hasMultipleSelector()}  
  <textarea name="url" class="form-control urls" placeholder="http://example.com/file1.jpg                                                                     http://example.com/file2.jpg" /></textarea>
{else:}
  <input type="text" name="url" class="form-control url" value="" placeholder="http://example.com/file.jpg" />
{end:}
  <div class="checkbox">
    <label><input type="checkbox" name="copy-to-file" value="1" class="copy-to-file" />{t(#Copy to file system#)}</label>
  </div>
  <button type="button" class="btn btn-default">{t(#Upload#)}</button>  
</div>
