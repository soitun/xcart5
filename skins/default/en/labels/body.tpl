{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Labels
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<ul class="labels">
  <li FOREACH="getLabels(),key,name" class="label-{key:h}"><div>{name}</div></li>
</ul>
