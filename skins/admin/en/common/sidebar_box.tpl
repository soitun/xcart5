{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Side bar box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="side-bar-box">
  <h2 IF="getHead()">{t(getHead())}</h2>
  <div class="content"><widget template="{getBody()}"></div>
</div>
