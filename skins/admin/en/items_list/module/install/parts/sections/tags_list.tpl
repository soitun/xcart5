{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="marketplace.landing.controls", weight="200")
 *}

<div class="tags-list-box">
  <span class="icon icon-tags"></span>
  <label for="edit-field-tags-tid">{t(#Tags#)}</label>

  <div class="tag-list">
    <div FOREACH="getTagsData(),name,url" class="tag-item"><a href="{url}">{getTagName(name)}</a></div>
  </div>
</div>
