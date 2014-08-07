{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Center box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="layout.main.center", weight="200")
 *}

<div id="content" class="column">
  <widget IF="{isTrialNoticeAutoDisplay()}" class="\XLite\View\ModulesManager\TrialNotice" />
  <div class="section">
    <a id="main-content"></a>
    <widget template="center.tpl" />
  </div>
</div>
