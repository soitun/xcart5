{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Header notice
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="top_links.version_notes", weight="400")
 *}
<li IF="isNoticeActive()" class="notice">
  <widget class="\XLite\View\Button\ActivateKey" />
  <widget class="\XLite\View\Button\TrialNotice" IF="isTrialNoticeAutoDisplay()" />
</li>
