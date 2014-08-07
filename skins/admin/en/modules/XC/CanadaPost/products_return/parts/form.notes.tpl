{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Canada Post products return :: from :: customer notes
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="capost_return.form", weight="400")
 *}

<div IF="isCustomerNotesVisible()" class="customer-notes">
  
  <h2>{t(#Customer note#)}</h2>
  
  <div class="note">{productsReturn.getNotes()}</div>

</div>
