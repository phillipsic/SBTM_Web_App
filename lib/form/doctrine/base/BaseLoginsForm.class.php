<?php

/**
 * Logins form base class.
 *
 * @method Logins getObject() Returns the current form's model object
 *
 * @package    PQASBTM
 * @subpackage form
 * @author     PQASBTM
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLoginsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInputText(),
      'username'   => new sfWidgetFormInputText(),
      'password'   => new sfWidgetFormInputPassword(),
      'email'      => new sfWidgetFormInputText(),
      'role_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Role'), 'add_empty' => false)),
      'islocked'   => new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1)),
     // 'created_at' => new sfWidgetFormDateTime(),
      //'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 255)),
      'username'   => new sfValidatorString(array('max_length' => 255)),
      'password'   => new sfValidatorString(array('max_length' => 255)),
      'email'      => new sfValidatorEmail(array('max_length' => 255)),
      'role_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Role'))),
      'islocked'   => new sfValidatorBoolean(),

      //new sfValidatorChoice(array('choices' => array('Yes'), 'empty_value' => 'No')),
      //'created_at' => new sfValidatorDateTime(),
      //'updated_at' => new sfValidatorDateTime(),
    ));


$this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'Logins', 'column' => array('name'))),
        new sfValidatorDoctrineUnique(array('model' => 'Logins', 'column' => array('username'))),
      ))
    );
$this->validatorSchema['password'] = new sfValidatorAnd(array(
$this->validatorSchema['password'],
new sfValidatorString(array('max_length' => 25)),
));
$this->widgetSchema['password_confirmation'] = new sfWidgetFormInputPassword();
$this->widgetSchema->setLabel('password_confirmation', 'Password confirm');
$this->validatorSchema['password_confirmation'] = clone $this->validatorSchema['password'];
$this->widgetSchema->moveField('password_confirmation', 'after', 'password');
$this->mergePostValidator(new sfValidatorSchemaCompare('password',
sfValidatorSchemaCompare::EQUAL, 'password_confirmation',
array(),
array('invalid' => 'Passwords do not match.')));


    $this->widgetSchema->setNameFormat('logins[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Logins';
  }

}
