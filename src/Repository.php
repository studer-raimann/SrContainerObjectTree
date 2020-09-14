<?php

namespace srag\Plugins\SrContainerObjectTree;

use ilSrContainerObjectTreePlugin;
use srag\DIC\SrContainerObjectTree\DICTrait;
use srag\Plugins\SrContainerObjectTree\ObjectSettings\Repository as ObjectSettingsRepository;
use srag\Plugins\SrContainerObjectTree\Tree\Repository as TreeRepository;
use srag\Plugins\SrContainerObjectTree\Utils\SrContainerObjectTreeTrait;

/**
 * Class Repository
 *
 * @package srag\Plugins\SrContainerObjectTree
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class Repository
{

    use DICTrait;
    use SrContainerObjectTreeTrait;

    const PLUGIN_CLASS_NAME = ilSrContainerObjectTreePlugin::class;
    /**
     * @var self|null
     */
    protected static $instance = null;


    /**
     * Repository constructor
     */
    private function __construct()
    {

    }


    /**
     * @return self
     */
    public static function getInstance() : self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    /**
     *
     */
    public function dropTables()/* : void*/
    {
        $this->objectSettings()->dropTables();
        $this->tree()->dropTables();
    }


    /**
     *
     */
    public function installTables()/* : void*/
    {
        $this->objectSettings()->installTables();
        $this->tree()->installTables();
    }


    /**
     * @return ObjectSettingsRepository
     */
    public function objectSettings() : ObjectSettingsRepository
    {
        return ObjectSettingsRepository::getInstance();
    }


    /**
     * @return TreeRepository
     */
    public function tree() : TreeRepository
    {
        return TreeRepository::getInstance();
    }
}