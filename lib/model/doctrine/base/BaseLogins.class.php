<?php

/**
 * BaseLogins
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $role_id
 * @property string $islocked
 * @property Role $Role
 * 
 * @method string  getName()     Returns the current record's "name" value
 * @method string  getUsername() Returns the current record's "username" value
 * @method string  getPassword() Returns the current record's "password" value
 * @method string  getEmail()    Returns the current record's "email" value
 * @method integer getRoleId()   Returns the current record's "role_id" value
 * @method string  getIslocked() Returns the current record's "islocked" value
 * @method Role    getRole()     Returns the current record's "Role" value
 * @method Logins  setName()     Sets the current record's "name" value
 * @method Logins  setUsername() Sets the current record's "username" value
 * @method Logins  setPassword() Sets the current record's "password" value
 * @method Logins  setEmail()    Sets the current record's "email" value
 * @method Logins  setRoleId()   Sets the current record's "role_id" value
 * @method Logins  setIslocked() Sets the current record's "islocked" value
 * @method Logins  setRole()     Sets the current record's "Role" value
 * 
 * @package    PQASBTM
 * @subpackage model
 * @author     Mohamed Sithik
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLogins extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('logins');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('username', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 255,
             ));
        $this->hasColumn('password', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('role_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('islocked', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Role', array(
             'local' => 'role_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}