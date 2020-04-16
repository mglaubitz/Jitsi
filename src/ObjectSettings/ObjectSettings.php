<?php

namespace srag\Plugins\Jitsi\ObjectSettings;

use ActiveRecord;
use arConnector;
use ilJitsiPlugin;
use srag\DIC\Jitsi\DICTrait;
use srag\Plugins\Jitsi\Utils\JitsiTrait;

/**
 * Class ObjectSettings
 * Generated by SrPluginGenerator v1.3.5
 * @package srag\Plugins\Jitsi\ObjectSettings
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 * @author  studer + raimann ag - Team Core 1 <support-core1@studer-raimann.ch>
 */
class ObjectSettings extends ActiveRecord
{

    use DICTrait;
    use JitsiTrait;
    const TABLE_NAME = "rep_robj_xjit_set";
    const PLUGIN_CLASS_NAME = ilJitsiPlugin::class;

    /**
     * @inheritDoc
     */
    public function getConnectorContainerName() : string
    {
        return self::TABLE_NAME;
    }

    /**
     * @inheritDoc
     * @deprecated
     */
    public static function returnDbTableName() : string
    {
        return self::TABLE_NAME;
    }

    /**
     * @var int
     * @con_has_field    true
     * @con_fieldtype    integer
     * @con_length       8
     * @con_is_notnull   true
     * @con_is_primary   true
     */
    protected $obj_id;
    /**
     * @var bool
     * @con_has_field    true
     * @con_fieldtype    integer
     * @con_length       1
     * @con_is_notnull   true
     */
    protected $is_online = false;

    /**
     * @var string
     * @con_has_field    true
     * @con_fieldtype    text
     * @con_length       254
     */
    protected $jitsi_id = '';

    /**
     * ObjectSettings constructor
     * @param int              $primary_key_value
     * @param arConnector|null $connector
     */
    public function __construct(/*int*/ $primary_key_value = 0, arConnector $connector = null)
    {
        parent::__construct($primary_key_value, $connector);
    }

    /**
     * @inheritDoc
     */
    public function sleep(/*string*/ $field_name)
    {
        $field_value = $this->{$field_name};

        switch ($field_name) {
            case "is_online":
                return ($field_value ? 1 : 0);
                break;

            default:
                return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function wakeUp(/*string*/ $field_name, $field_value)
    {
        switch ($field_name) {
            case "obj_id":
                return intval($field_value);
                break;

            case "is_online":
                return boolval($field_value);
                break;

            default:
                return null;
        }
    }

    /**
     * @return int
     */
    public function getObjId() : int
    {
        return $this->obj_id;
    }

    /**
     * @param int $obj_id
     */
    public function setObjId(int $obj_id)/*: void*/
    {
        $this->obj_id = $obj_id;
    }

    /**
     * @return bool
     */
    public function isOnline() : bool
    {
        return $this->is_online;
    }

    /**
     * @param bool $is_online
     */
    public function setOnline(bool $is_online = true)/*: void*/
    {
        $this->is_online = $is_online;
    }

    /**
     * @return string
     */
    public function getJitsiId() : string
    {
        return $this->jitsi_id;
    }

    /**
     * @param string $jitsi_id
     */
    public function setJitsiId(string $jitsi_id)
    {
        $this->jitsi_id = $jitsi_id;
    }

    public function generareJitsiId(Repository $setting)
    {
        //$uniqid = uniqid('jit', true);
        $uniqid = str_pad(rand(0,'9'.round(microtime(true))),11, "0", STR_PAD_LEFT);
        $this->setJitsiId($uniqid);
        $setting->storeObjectSettings($this);
    }

}
