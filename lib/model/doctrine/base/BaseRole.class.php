<?php

/**
 * BaseRole
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property Doctrine_Collection $Role
 * 
 * @method string              getName() Returns the current record's "name" value
 * @method Doctrine_Collection getRole() Returns the current record's "Role" collection
 * @method Role                setName() Sets the current record's "name" value
 * @method Role                setRole() Sets the current record's "Role" collection
 * 
 * @package    PQASBTM
 * @subpackage model
 * @author     Mohamed Sithik
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseRole extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('role');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Logins as Role', array(
             'local' => 'id',
             'foreign' => 'role_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}