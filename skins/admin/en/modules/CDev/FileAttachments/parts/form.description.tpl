{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Deswcription
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.attachments.form", weight="200", zone="admin")
 *}
<tr class="description">
  <td class="label"><label for="attachmentDesc{attachment.getId()}">{t(#Description#)}</label></td>
  <td><textarea id="attachmentDesc{attachment.getId()}" name="data[{attachment.getId()}][description]">{attachment.getDescription()}</textarea></td>
</tr>
