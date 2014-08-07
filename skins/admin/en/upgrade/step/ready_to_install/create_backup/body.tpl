{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Create backup warnings
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

 <div class="create-backup-section">
   <div class="create-backup-section-frame">

     <div class="header">{t(#Create a backup#)}!</div>

     <div class="description safe-mode-description">
       {t(#If your store is crashed after upgrade, you can recover it#,_ARRAY_(#article#^getArticleURL())):h}
     </div>

     <list name="actions" type="inherited" />

     <div class="description last-message">
       {t(#Please save these links before proceeding!#)}
     </div>

   </div>
 </div>
