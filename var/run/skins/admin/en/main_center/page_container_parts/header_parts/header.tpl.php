<?php if (!($this->get('auth')->isAdmin())): ?><h1 ><?php echo func_htmlspecialchars($this->t('Administration Zone')); ?></h1><?php endif; ?>
