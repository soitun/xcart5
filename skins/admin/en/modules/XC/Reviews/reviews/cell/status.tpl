{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Review status
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="approved" IF="isApproved(entity)">{t(#Published#)}</div>
<div class="pending" IF="!isApproved(entity)">{t(#Pending#)}</div>
