<?php
/**
 * Created by PhpStorm.
 *
 * Doctrine Bundle Project
 * (c) 2019 Craig Rayner <craig@craigrayner.com>
 *
 * User: craig
 * Date: 23/11/2018
 * Time: 11:17
 */
namespace Crayner\Doctrine\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;

/**
 * Class TablePrefixSubscriber
 * @package Crayner\Doctrine\Listener
 */
class TablePrefixSubscriber implements EventSubscriber
{
    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array('loadClassMetadata');
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $params = $eventArgs->getEntityManager()->getConnection()->getParams();
        $prefix = empty($params['driverOptions']['prefix']) ? $this->getPrefix() : $params['driverOptions']['prefix'];
        if (empty($prefix)) return;
        $prefix = mb_substr(preg_replace('/\s/', '', $prefix), 0, 7);
        if (empty($prefix)) return;

        $classMetadata = $eventArgs->getClassMetadata();

        if (!$classMetadata->isInheritanceTypeSingleTable() || $classMetadata->getName() === $classMetadata->rootEntityName)
        {
            $tableName = $classMetadata->getTableName();
            if (strpos($tableName, $prefix) !== 0)
                $classMetadata->setPrimaryTable(['name' => $prefix . $tableName]);
        }
        foreach ($classMetadata->getAssociationMappings() as $fieldName => $mapping)
            if ($mapping['type'] == \Doctrine\ORM\Mapping\ClassMetadataInfo::MANY_TO_MANY && $mapping['isOwningSide'])
                if (strpos($mapping['joinTable']['name'], $prefix) !== 0)
                    $classMetadata->associationMappings[$fieldName]['joinTable']['name'] = $prefix . $mapping['joinTable']['name'];
    }

    /**
     * @var string|null
     */
    private $prefix;

    /**
     * @return string|null
     */
    public function getPrefix(): string
    {
        return $this->prefix ?: '';
    }

    /**
     * @param string|null $prefix
     * @return TablePrefixSubscriber
     */
    public function setPrefix(?string $prefix): TablePrefixSubscriber
    {
        $this->prefix = $prefix;
        return $this;
    }
}