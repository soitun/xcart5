<?php die(); ?>          0O:34:"Doctrine\ORM\Mapping\ClassMetadata":13:{s:19:"associationMappings";a:2:{s:5:"order";a:19:{s:9:"fieldName";s:5:"order";s:11:"joinColumns";a:1:{i:0;a:6:{s:4:"name";s:8:"order_id";s:20:"referencedColumnName";s:8:"order_id";s:6:"unique";b:0;s:8:"nullable";b:1;s:8:"onDelete";N;s:16:"columnDefinition";N;}}s:7:"cascade";a:0:{}s:10:"inversedBy";s:11:"usedCoupons";s:12:"targetEntity";s:17:"XLite\Model\Order";s:5:"fetch";i:2;s:4:"type";i:2;s:8:"mappedBy";N;s:12:"isOwningSide";b:1;s:12:"sourceEntity";s:42:"XLite\Module\CDev\Coupons\Model\UsedCoupon";s:15:"isCascadeRemove";b:0;s:16:"isCascadePersist";b:0;s:16:"isCascadeRefresh";b:0;s:14:"isCascadeMerge";b:0;s:15:"isCascadeDetach";b:0;s:24:"sourceToTargetKeyColumns";a:1:{s:8:"order_id";s:8:"order_id";}s:20:"joinColumnFieldNames";a:1:{s:8:"order_id";s:8:"order_id";}s:24:"targetToSourceKeyColumns";a:1:{s:8:"order_id";s:8:"order_id";}s:13:"orphanRemoval";b:0;}s:6:"coupon";a:19:{s:9:"fieldName";s:6:"coupon";s:11:"joinColumns";a:1:{i:0;a:6:{s:4:"name";s:9:"coupon_id";s:20:"referencedColumnName";s:2:"id";s:6:"unique";b:0;s:8:"nullable";b:1;s:8:"onDelete";s:8:"SET NULL";s:16:"columnDefinition";N;}}s:7:"cascade";a:0:{}s:10:"inversedBy";s:11:"usedCoupons";s:12:"targetEntity";s:38:"XLite\Module\CDev\Coupons\Model\Coupon";s:5:"fetch";i:2;s:4:"type";i:2;s:8:"mappedBy";N;s:12:"isOwningSide";b:1;s:12:"sourceEntity";s:42:"XLite\Module\CDev\Coupons\Model\UsedCoupon";s:15:"isCascadeRemove";b:0;s:16:"isCascadePersist";b:0;s:16:"isCascadeRefresh";b:0;s:14:"isCascadeMerge";b:0;s:15:"isCascadeDetach";b:0;s:24:"sourceToTargetKeyColumns";a:1:{s:9:"coupon_id";s:2:"id";}s:20:"joinColumnFieldNames";a:1:{s:9:"coupon_id";s:9:"coupon_id";}s:24:"targetToSourceKeyColumns";a:1:{s:2:"id";s:9:"coupon_id";}s:13:"orphanRemoval";b:0;}}s:11:"columnNames";a:3:{s:2:"id";s:2:"id";s:4:"code";s:4:"code";s:5:"value";s:5:"value";}s:13:"fieldMappings";a:3:{s:2:"id";a:9:{s:9:"fieldName";s:2:"id";s:4:"type";s:8:"uinteger";s:6:"length";N;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:2:"id";b:1;s:10:"columnName";s:2:"id";}s:4:"code";a:8:{s:9:"fieldName";s:4:"code";s:4:"type";s:11:"fixedstring";s:6:"length";i:16;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:4:"code";}s:5:"value";a:8:{s:9:"fieldName";s:5:"value";s:4:"type";s:7:"decimal";s:6:"length";N;s:9:"precision";i:14;s:5:"scale";i:4;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:5:"value";}}s:10:"fieldNames";a:3:{s:2:"id";s:2:"id";s:4:"code";s:4:"code";s:5:"value";s:5:"value";}s:10:"identifier";a:1:{i:0;s:2:"id";}s:21:"isIdentifierComposite";b:0;s:4:"name";s:42:"XLite\Module\CDev\Coupons\Model\UsedCoupon";s:9:"namespace";s:31:"XLite\Module\CDev\Coupons\Model";s:5:"table";a:1:{s:4:"name";s:16:"xc_order_coupons";}s:14:"rootEntityName";s:42:"XLite\Module\CDev\Coupons\Model\UsedCoupon";s:11:"idGenerator";O:33:"Doctrine\ORM\Id\IdentityGenerator":1:{s:43:" Doctrine\ORM\Id\IdentityGenerator _seqName";N;}s:25:"customRepositoryClassName";s:29:"\XLite\Model\Repo\Base\Common";s:13:"generatorType";i:4;}