<?php die(); ?>          0O:34:"Doctrine\ORM\Mapping\ClassMetadata":13:{s:19:"associationMappings";a:2:{s:8:"shipment";a:19:{s:9:"fieldName";s:8:"shipment";s:11:"joinColumns";a:1:{i:0;a:6:{s:4:"name";s:10:"shipmentId";s:20:"referencedColumnName";s:2:"id";s:6:"unique";b:0;s:8:"nullable";b:1;s:8:"onDelete";N;s:16:"columnDefinition";N;}}s:7:"cascade";a:0:{}s:10:"inversedBy";s:5:"links";s:12:"targetEntity";s:54:"XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment";s:5:"fetch";i:2;s:4:"type";i:2;s:8:"mappedBy";N;s:12:"isOwningSide";b:1;s:12:"sourceEntity";s:59:"XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link";s:15:"isCascadeRemove";b:0;s:16:"isCascadePersist";b:0;s:16:"isCascadeRefresh";b:0;s:14:"isCascadeMerge";b:0;s:15:"isCascadeDetach";b:0;s:24:"sourceToTargetKeyColumns";a:1:{s:10:"shipmentId";s:2:"id";}s:20:"joinColumnFieldNames";a:1:{s:10:"shipmentId";s:10:"shipmentId";}s:24:"targetToSourceKeyColumns";a:1:{s:2:"id";s:10:"shipmentId";}s:13:"orphanRemoval";b:0;}s:7:"storage";a:16:{s:9:"fieldName";s:7:"storage";s:12:"targetEntity";s:67:"XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link\Storage";s:11:"joinColumns";a:0:{}s:8:"mappedBy";s:4:"link";s:10:"inversedBy";N;s:7:"cascade";a:5:{i:0;s:6:"remove";i:1;s:7:"persist";i:2;s:7:"refresh";i:3;s:5:"merge";i:4;s:6:"detach";}s:13:"orphanRemoval";b:0;s:5:"fetch";i:3;s:4:"type";i:1;s:12:"isOwningSide";b:0;s:12:"sourceEntity";s:59:"XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link";s:15:"isCascadeRemove";b:1;s:16:"isCascadePersist";b:1;s:16:"isCascadeRefresh";b:1;s:14:"isCascadeMerge";b:1;s:15:"isCascadeDetach";b:1;}}s:11:"columnNames";a:5:{s:2:"id";s:2:"id";s:3:"rel";s:3:"rel";s:4:"href";s:4:"href";s:3:"idx";s:3:"idx";s:9:"mediaType";s:9:"mediaType";}s:13:"fieldMappings";a:5:{s:2:"id";a:9:{s:9:"fieldName";s:2:"id";s:4:"type";s:7:"integer";s:6:"length";N;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:2:"id";b:1;s:10:"columnName";s:2:"id";}s:3:"rel";a:8:{s:9:"fieldName";s:3:"rel";s:4:"type";s:6:"string";s:6:"length";i:255;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:3:"rel";}s:4:"href";a:8:{s:9:"fieldName";s:4:"href";s:4:"type";s:6:"string";s:6:"length";i:255;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:4:"href";}s:3:"idx";a:8:{s:9:"fieldName";s:3:"idx";s:4:"type";s:7:"integer";s:6:"length";N;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:1;s:6:"unique";b:0;s:10:"columnName";s:3:"idx";}s:9:"mediaType";a:8:{s:9:"fieldName";s:9:"mediaType";s:4:"type";s:6:"string";s:6:"length";i:255;s:9:"precision";i:0;s:5:"scale";i:0;s:8:"nullable";b:0;s:6:"unique";b:0;s:10:"columnName";s:9:"mediaType";}}s:10:"fieldNames";a:5:{s:2:"id";s:2:"id";s:3:"rel";s:3:"rel";s:4:"href";s:4:"href";s:3:"idx";s:3:"idx";s:9:"mediaType";s:9:"mediaType";}s:10:"identifier";a:1:{i:0;s:2:"id";}s:21:"isIdentifierComposite";b:0;s:4:"name";s:59:"XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link";s:9:"namespace";s:54:"XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment";s:5:"table";a:1:{s:4:"name";s:37:"xc_order_capost_parcel_shipment_links";}s:14:"rootEntityName";s:59:"XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link";s:11:"idGenerator";O:33:"Doctrine\ORM\Id\IdentityGenerator":1:{s:43:" Doctrine\ORM\Id\IdentityGenerator _seqName";N;}s:25:"customRepositoryClassName";s:29:"\XLite\Model\Repo\Base\Common";s:13:"generatorType";i:4;}