{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * RSS
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="feeds clearfix">
  <h2>{t(#X-Cart News#)}</h2>
  <ul>
    <li FOREACH="getFeeds(),feed">
      <h3>{formatDate(feed.date)}</h3>
      <a href="{feed.link}" target="_blank">{feed.title}</a>
    </li>
  </ul>
  <a href="{getRSSFeedUrl()}" target="_blank" class="rss-feed">{t(#RSS feed#)}</a>
  <a href="{getBlogUrl()}" target="_blank" class="blog">{t(#Our Blog#)}</a>
</div>
