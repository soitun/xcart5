<div class="feeds clearfix">
  <h2><?php echo func_htmlspecialchars($this->t('X-Cart News')); ?></h2>
  <ul>
    <?php $feed = isset($this->feed) ? $this->feed : null; $_foreach_var = $this->getFeeds(); if (isset($_foreach_var)) { $this->feedArraySize=count($_foreach_var); $this->feedArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->feed){ $this->feedArrayPointer++; ?><li >
      <h3><?php echo func_htmlspecialchars($this->formatDate($this->getComplex('feed.date'))); ?></h3>
      <a href="<?php echo func_htmlspecialchars($this->getComplex('feed.link')); ?>" target="_blank"><?php echo func_htmlspecialchars($this->getComplex('feed.title')); ?></a>
    </li>
<?php } $this->feed = $feed; ?>
  </ul>
  <a href="<?php echo func_htmlspecialchars($this->getRSSFeedUrl()); ?>" target="_blank" class="rss-feed"><?php echo func_htmlspecialchars($this->t('RSS feed')); ?></a>
  <a href="<?php echo func_htmlspecialchars($this->getBlogUrl()); ?>" target="_blank" class="blog"><?php echo func_htmlspecialchars($this->t('Our Blog')); ?></a>
</div>
