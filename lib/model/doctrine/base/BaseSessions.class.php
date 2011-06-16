<?php

/**
 * BaseSessions
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $sessionname
 * @property string $charter
 * @property string $areas
 * @property string $testnotes
 * @property string $ready
 * @property string $tester
 * @property integer $status_id
 * @property integer $project_id
 * @property integer $strategy_id
 * @property Status $Status
 * @property ProjectCategory $ProjectCategory
 * @property Strategy $Strategy
 * 
 * @method string          getSessionname()     Returns the current record's "sessionname" value
 * @method string          getCharter()         Returns the current record's "charter" value
 * @method string          getAreas()           Returns the current record's "areas" value
 * @method string          getTestnotes()       Returns the current record's "testnotes" value
 * @method string          getReady()           Returns the current record's "ready" value
 * @method string          getTester()          Returns the current record's "tester" value
 * @method integer         getStatusId()        Returns the current record's "status_id" value
 * @method integer         getProjectId()       Returns the current record's "project_id" value
 * @method integer         getStrategyId()      Returns the current record's "strategy_id" value
 * @method Status          getStatus()          Returns the current record's "Status" value
 * @method ProjectCategory getProjectCategory() Returns the current record's "ProjectCategory" value
 * @method Strategy        getStrategy()        Returns the current record's "Strategy" value
 * @method Sessions        setSessionname()     Sets the current record's "sessionname" value
 * @method Sessions        setCharter()         Sets the current record's "charter" value
 * @method Sessions        setAreas()           Sets the current record's "areas" value
 * @method Sessions        setTestnotes()       Sets the current record's "testnotes" value
 * @method Sessions        setReady()           Sets the current record's "ready" value
 * @method Sessions        setTester()          Sets the current record's "tester" value
 * @method Sessions        setStatusId()        Sets the current record's "status_id" value
 * @method Sessions        setProjectId()       Sets the current record's "project_id" value
 * @method Sessions        setStrategyId()      Sets the current record's "strategy_id" value
 * @method Sessions        setStatus()          Sets the current record's "Status" value
 * @method Sessions        setProjectCategory() Sets the current record's "ProjectCategory" value
 * @method Sessions        setStrategy()        Sets the current record's "Strategy" value
 * 
 * @package    PQASBTM
 * @subpackage model
 * @author     Mohamed Sithik
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSessions extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sessions');
        $this->hasColumn('sessionname', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 255,
             ));
        $this->hasColumn('charter', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('areas', 'string', 800, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 800,
             ));
        $this->hasColumn('testnotes', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('ready', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('tester', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('status_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('project_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('strategy_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Status', array(
             'local' => 'status_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('ProjectCategory', array(
             'local' => 'project_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Strategy', array(
             'local' => 'strategy_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}