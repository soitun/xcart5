<?php die(); ?>          0O:34:"Doctrine\ORM\Mapping\ClassMetadata":13:{s:19:"associationMappings";a:3:{s:5:"order";a:19:{s:9:"fieldName";s:5:"order";s:11:"joinColumns";a:1:{i:0;a:6:{s:4:"name";s:8:"order_id";s:20:"referencedColumnName";s:8:"order_id";s:6:"unique";b:0;s:8:"nullable";b:1;s:8:"onDelete";N;s:16:"columnDefinition";N;}}s:7:"cascade";a:0:{}s:10:"inversedBy";s:13:"capostParcels";s:12:"targetEntity";s:17:"XLite\Model\Order";s:5:"fetch";i:2;s:4:"type";i:2;s:8:"mappedBy";N;s:12:"isOwningSide";b:1;s:12:"sourceEntity";s:45:"XLite\Module\XC\CanadaPost\Model\Order\Parcel";s:15:"isCascadeRemove";b:0;s:16:"isCascadePersist";b:0;s:16:"isCascadeRefresh";b:0;s:14:"isCascadeMerge";b:0;s:15:"isCascadeDetach";b:0;s:24:"sourceToTargetKeyColumns";a:1:{s:8:"order_id";s:8:"order_id";}s:20:"joinColumnFieldNames";a:1:{s:8:"order_id";s:8:"order_id";}s:24:"targetToSourceKeyColumns";a:1:{s:8:"order_id";s:8:"order_id";}s:13:"orphanRemoval";b:0;}s:5:"items";a:15:{s:9:"fieldName";s:5:"items";s:8:"mappedBy";s:6:"parcel";s:12:"targetEntity";s:50:"XLite\Module\XC\CanadaPost\Model\Order\Parcel\Item";s:7:"cascade";a:5:{i:0;s:6:"remove";i:1;s:7:"persist";i:2;s:7:"refresh";i:3;s:5:"merge";i:4;s:6:"detach";}s:13:"orphanRemoval";b:0;s:5:"fetch";i:2;s:4:"type";i:4;s:10:"inversedBy";N;s:12:"isOwningSide";b:0;s:12:"sourceEntity";s:45:"XLite\Module\XC\CanadaPost\Model\Order\Parcel";s:15:"isCascadeRemove";b:1;s:16:"isCascadePersist";b:1;s:16:"isCascadeRefresh";b:1;s:14:"isCascadeMerge";b:1;s:15:"isCascadeDetach";b:1;}s:8:"shipment";a:16:{s:9:"fieldName";s:8:"shipment";s:12:"targetEntity";s:54:"XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment";s:11:"joinColumns";a:0:{}s:8:"mappedBy";s:6:"parcel";s:10:"inversedBy";N;s:7:"cascade";a:5:{i:0;s:6:"remove";i:1;s:7:"persist";i:2;s:7:"refresh";i:3;s:5:"merge";i:4;s:6:"detach";}s:13:"orphanRemoval";b:0;s:5:"fetch";i:2;s:4:"type";i:1;s:12:"isOwningSide";b:0;s:12:"sourceEntity";s:45:"XLite\Module\XC\CanadaPost\Model\Order\Parcel";s:15:"isCascadeRemove";b:1;s:16:"isCascadePersist";b:1;s:16:"isCascadeRefresh";b:1;s:14:"isCascadeMerge";b:1;s:15:"isCascadeDetach";b:1;}}s:11:"columnNames";a:20:{s:2:"id";s:2:"id";s:6:"number";s:6:"number";s:6:"status";s:6:"status";s:9:"quoteType";s:9:"quoteType";s:9:"boxWeight";s:9:"boxWeight";s:8:"boxWidth";s:8:"boxWidth";s:9:"boxLength";s:9:"boxLength";s:9:"boxHeight";s:9:"boxHeight";s:10:"isDocument";s:10:"isDocument";s:12:"isUnpackaged";s:12:"isUnpackaged";s:13:"isMailingTube";s:13:"isMailingTube";s:11:"isOversized";s:11:"isOversized";s:16:"notifyOnShipment";s:16:"notifyOnShipment";s:17:"notifyOnException";s:17:"notifyOnException";s:16:"notifyOnDelivery";s:16:"notifyOnDelivery";s:12:"optSignature";s:12:"optSignature";s:11:"optCoverage";s:11:"optCoverage";s:11:"optAgeProof";s:11:"optAgeProof";s:15:"optWayToDeliver";s:15:"optWayToDeliver";s:14:"optNonDelivery";s:14:"optNonDelivery";}s:13:"fieldMappings";a:20:{s:2:"id";a:9:{s:9:"fieldName";s:2:"id";s:4:"type";s:7:"integer";s:6:"length";N;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:2:"id";b:1;s:10:"columnName";s:2:"id";}s:6:"number";a:8:{s:9:"fieldName";s:6:"number";s:4:"type";s:7:"integer";s:6:"length";N;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:6:"number";}s:6:"status";a:8:{s:9:"fieldName";s:6:"status";s:4:"type";s:11:"fixedstring";s:6:"length";i:2;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:6:"status";}s:9:"quoteType";a:8:{s:9:"fieldName";s:9:"quoteType";s:4:"type";s:11:"fixedstring";s:6:"length";i:2;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:9:"quoteType";}s:9:"boxWeight";a:8:{s:9:"fieldName";s:9:"boxWeight";s:4:"type";s:7:"decimal";s:6:"length";N;s:9:"precision";i:14;s:5:"scale";i:4;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:9:"boxWeight";}s:8:"boxWidth";a:8:{s:9:"fieldName";s:8:"boxWidth";s:4:"type";s:7:"decimal";s:6:"length";N;s:9:"precision";i:14;s:5:"scale";i:4;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:8:"boxWidth";}s:9:"boxLength";a:8:{s:9:"fieldName";s:9:"boxLength";s:4:"type";s:7:"decimal";s:6:"length";N;s:9:"precision";i:14;s:5:"scale";i:4;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:9:"boxLength";}s:9:"boxHeight";a:8:{s:9:"fieldName";s:9:"boxHeight";s:4:"type";s:7:"decimal";s:6:"length";N;s:9:"precision";i:14;s:5:"scale";i:4;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:9:"boxHeight";}s:10:"isDocument";a:8:{s:9:"fieldName";s:10:"isDocument";s:4:"type";s:7:"boolean";s:6:"length";N;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:10:"isDocument";}s:12:"isUnpackaged";a:8:{s:9:"fieldName";s:12:"isUnpackaged";s:4:"type";s:7:"boolean";s:6:"length";N;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:12:"isUnpackaged";}s:13:"isMailingTube";a:8:{s:9:"fieldName";s:13:"isMailingTube";s:4:"type";s:7:"boolean";s:6:"length";N;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:13:"isMailingTube";}s:11:"isOversized";a:8:{s:9:"fieldName";s:11:"isOversized";s:4:"type";s:7:"boolean";s:6:"length";N;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:11:"isOversized";}s:16:"notifyOnShipment";a:8:{s:9:"fieldName";s:16:"notifyOnShipment";s:4:"type";s:7:"boolean";s:6:"length";N;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:16:"notifyOnShipment";}s:17:"notifyOnException";a:8:{s:9:"fieldName";s:17:"notifyOnException";s:4:"type";s:7:"boolean";s:6:"length";N;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:17:"notifyOnException";}s:16:"notifyOnDelivery";a:8:{s:9:"fieldName";s:16:"notifyOnDelivery";s:4:"type";s:7:"boolean";s:6:"length";N;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:16:"notifyOnDelivery";}s:12:"optSignature";a:8:{s:9:"fieldName";s:12:"optSignature";s:4:"type";s:7:"boolean";s:6:"length";N;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:12:"optSignature";}s:11:"optCoverage";a:8:{s:9:"fieldName";s:11:"optCoverage";s:4:"type";s:7:"decimal";s:6:"length";N;s:9:"precision";i:14;s:5:"scale";i:4;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:11:"optCoverage";}s:11:"optAgeProof";a:8:{s:9:"fieldName";s:11:"optAgeProof";s:4:"type";s:6:"string";s:6:"length";i:4;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:11:"optAgeProof";}s:15:"optWayToDeliver";a:8:{s:9:"fieldName";s:15:"optWayToDeliver";s:4:"type";s:6:"string";s:6:"length";i:3;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:15:"optWayToDeliver";}s:14:"optNonDelivery";a:8:{s:9:"fieldName";s:14:"optNonDelivery";s:4:"type";s:6:"string";s:6:"length";i:4;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:14:"optNonDelivery";}}s:10:"fieldNames";a:20:{s:2:"id";s:2:"id";s:6:"number";s:6:"number";s:6:"status";s:6:"status";s:9:"quoteType";s:9:"quoteType";s:9:"boxWeight";s:9:"boxWeight";s:8:"boxWidth";s:8:"boxWidth";s:9:"boxLength";s:9:"boxLength";s:9:"boxHeight";s:9:"boxHeight";s:10:"isDocument";s:10:"isDocument";s:12:"isUnpackaged";s:12:"isUnpackaged";s:13:"isMailingTube";s:13:"isMailingTube";s:11:"isOversized";s:11:"isOversized";s:16:"notifyOnShipment";s:16:"notifyOnShipment";s:17:"notifyOnException";s:17:"notifyOnException";s:16:"notifyOnDelivery";s:16:"notifyOnDelivery";s:12:"optSignature";s:12:"optSignature";s:11:"optCoverage";s:11:"optCoverage";s:11:"optAgeProof";s:11:"optAgeProof";s:15:"optWayToDeliver";s:15:"optWayToDeliver";s:14:"optNonDelivery";s:14:"optNonDelivery";}s:10:"identifier";a:1:{i:0;s:2:"id";}s:21:"isIdentifierComposite";b:0;s:4:"name";s:45:"XLite\Module\XC\CanadaPost\Model\Order\Parcel";s:9:"namespace";s:38:"XLite\Module\XC\CanadaPost\Model\Order";s:5:"table";a:2:{s:4:"name";s:23:"xc_order_capost_parcels";s:7:"indexes";a:2:{s:6:"status";a:1:{s:7:"columns";a:1:{i:0;s:6:"status";}}s:6:"number";a:1:{s:7:"columns";a:1:{i:0;s:6:"number";}}}}s:14:"rootEntityName";s:45:"XLite\Module\XC\CanadaPost\Model\Order\Parcel";s:11:"idGenerator";O:33:"Doctrine\ORM\Id\IdentityGenerator":1:{s:43:" Doctrine\ORM\Id\IdentityGenerator _seqName";N;}s:25:"customRepositoryClassName";s:29:"\XLite\Model\Repo\Base\Common";s:13:"generatorType";i:4;}