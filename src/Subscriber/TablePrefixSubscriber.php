<?php

namespace DelPlop\DbBundle\Subscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

class TablePrefixSubscriber implements EventSubscriber
{
    /** @var string */
    private $tablePrefix;
    
    public function __construct(string $prefix = '')
    {
        $this->tablePrefix = $prefix;
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return ['loadClassMetadata'];
    }

    /**
     * @param LoadClassMetadataEventArgs $args
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $args)
    {
        $classMetadata = $args->getClassMetadata();
        if ($classMetadata->isInheritanceTypeSingleTable() && !$classMetadata->isRootEntity()) {
            // if we are in an inheritance hierarchy, only apply this once
            return;
        }

        $classMetadata->setTableName($this->tablePrefix.$classMetadata->getTableName());

        foreach ($classMetadata->getAssociationMappings() as $fieldName => $mapping) {
            if ($mapping['type'] == ClassMetadataInfo::MANY_TO_MANY) {
                if (!empty($classMetadata->associationMappings[$fieldName]['joinTable'])) {
                    $mappedTableName = $classMetadata->associationMappings[$fieldName]['joinTable']['name'];
                    $classMetadata->associationMappings[$fieldName]['joinTable']['name'] = $this->tablePrefix.$mappedTableName;
                }
            }
        }
    }
}
