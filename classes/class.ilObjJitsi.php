<?php

use srag\DIC\Jitsi\DICTrait;
use srag\Plugins\Jitsi\ObjectSettings\ObjectSettings;
use srag\Plugins\Jitsi\Utils\JitsiTrait;

/**
 * Class ilObjJitsi
 * Generated by SrPluginGenerator v1.3.5
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author studer + raimann ag - Team Core 1 <support-core1@studer-raimann.ch>
 */
class ilObjJitsi extends ilObjectPlugin
{

    use DICTrait;
    use JitsiTrait;
    const PLUGIN_CLASS_NAME = ilJitsiPlugin::class;
    /**
     * @var ObjectSettings
     */
    protected $object_settings;

    /**
     * ilObjJitsi constructor
     * @param int $a_ref_id
     */
    public function __construct(/*int*/ $a_ref_id = 0)
    {
        parent::__construct($a_ref_id);
    }

    /**
     * @inheritDoc
     */
    public final function initType()/*: void*/
    {
        $this->setType(ilJitsiPlugin::PLUGIN_ID);
    }

    /**
     * @inheritDoc
     */
    public function doCreate()/*: void*/
    {
        $this->object_settings = new ObjectSettings();

        $this->object_settings->setObjId($this->id);
        $this->object_settings->generareJitsiId(self::jitsi()->objectSettings());

        self::jitsi()->objectSettings()->storeObjectSettings($this->object_settings);
    }

    /**
     * @inheritDoc
     */
    public function doRead()/*: void*/
    {
        $this->object_settings = self::jitsi()->objectSettings()->getObjectSettingsById(intval($this->id));
        if (!$this->object_settings->getJitsiId()) {
            $this->object_settings->generareJitsiId(self::jitsi()->objectSettings());
        }
    }

    /**
     * @inheritDoc
     */
    public function doUpdate()/*: void*/
    {
        self::jitsi()->objectSettings()->storeObjectSettings($this->object_settings);
    }

    /**
     * @inheritDoc
     */
    public function doDelete()/*: void*/
    {
        if ($this->object_settings !== null) {
            self::jitsi()->objectSettings()->deleteObjectSettings($this->object_settings);
        }
    }

    /**
     * @inheritDoc
     * @param ilObjJitsi $new_obj
     */
    protected function doCloneObject(/*ilObjJitsi*/ $new_obj, /*int*/ $a_target_id, /*?int*/ $a_copy_id = null)/*: void*/
    {
        $new_obj->object_settings = self::jitsi()->objectSettings()->cloneObjectSettings($this->object_settings);

        $new_obj->object_settings->setObjId($new_obj->id);
        $new_obj->object_settings->setJitsiId($this->object_settings->getJitsiId());

        self::jitsi()->objectSettings()->storeObjectSettings($new_obj->object_settings);
    }

    /**
     * @return bool
     */
    public function isOnline() : bool
    {
        return $this->object_settings->isOnline();
    }

    /**
     * @param bool $is_online
     */
    public function setOnline(bool $is_online = true)/*: void*/
    {
        $this->object_settings->setOnline($is_online);
    }

    /**
     * @return ObjectSettings
     */
    public function getObjectSettings() : ObjectSettings
    {
        return $this->object_settings;
    }

}
