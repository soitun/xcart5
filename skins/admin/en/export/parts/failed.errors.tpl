{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Export failed section : errors
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="export.failed.content", weight="100")
 *}

<div class="errors">
  <ul>
    <li FOREACH="getErrors(),error">
      <h3>{error.title}</h3>
      <p>{error.body}</p>
    </li>
  </ul>
</div>
