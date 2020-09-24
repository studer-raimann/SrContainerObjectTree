<?php

namespace srag\Plugins\SrContainerObjectTree\ObjectSettings;

use ilSrContainerObjectTreePlugin;
use srag\DIC\SrContainerObjectTree\DICTrait;
use srag\Plugins\SrContainerObjectTree\ObjectSettings\UserSettings\Repository as UserSettingsRepository;
use srag\Plugins\SrContainerObjectTree\Utils\SrContainerObjectTreeTrait;

/**
 * Class Repository
 *
 * @package srag\Plugins\SrContainerObjectTree\ObjectSettings
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
     * @param ObjectSettings $object_settings
     *
     * @return ObjectSettings
     */
    public function cloneObjectSettings(ObjectSettings $object_settings) : ObjectSettings
    {
        return $object_settings->copy();
    }


    /**
     * @param ObjectSettings $object_settings
     */
    public function deleteObjectSettings(ObjectSettings $object_settings)/* : void*/
    {
        $object_settings->delete();
    }


    /**
     * @internal
     */
    public function dropTables()/* : void*/
    {
        self::dic()->database()->dropTable(ObjectSettings::TABLE_NAME, false);
        $this->userSettings()->dropTables();
    }


    /**
     * @return Factory
     */
    public function factory() : Factory
    {
        return Factory::getInstance();
    }


    /**
     * @param int $obj_id
     *
     * @return ObjectSettings|null
     */
    public function getObjectSettingsById(int $obj_id)/* : ?ObjectSettings*/
    {
        /**
         * @var ObjectSettings|null $object_settings
         */

        $object_settings = ObjectSettings::where([
            "obj_id" => $obj_id
        ])->first();

        return $object_settings;
    }


    /**
     * @internal
     */
    public function installTables()/* : void*/
    {
        ObjectSettings::updateDB();
        $this->userSettings()->installTables();
    }


    /**
     * @param ObjectSettings $object_settings
     */
    public function storeObjectSettings(ObjectSettings $object_settings)/* : void*/
    {
        $object_settings->store();
    }


    /**
     * @return UserSettingsRepository
     */
    public function userSettings() : UserSettingsRepository
    {
        return UserSettingsRepository::getInstance();
    }
}
