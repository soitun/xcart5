{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Import begin section : sections
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="import.begin.content", weight="100")
 *}

<div class="parts">
  <h3>{t(#Upload files#)}</h3>
  <input id="files" type="file" name="files[]" multiple="multiple" />
  <p>{getUploadFileMessage()}</p>
  <a href="{getSamplesURL()}" target="_blank">{t(#Import/Export guide#)}</a>
</div>
