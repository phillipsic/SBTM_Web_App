<?php

/**
 * Role form base class.
 *
 * @method Role getObject() Returns the current form's model object
 *
 * @package    QASBTM
 * @subpackage form
 * @author     QASBTM
 */
abstract class BaseSearchForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
       'SearchString'       => new sfWidgetFormInputText(),
   ));
    $this->widgetSchema->setLabel('SearchString', 'Enter the text to be searched');

    $this->setValidators(array(
      'SearchString'       => new sfValidatorString(array('max_length' => 255)),
     ));

//    $this->validatorSchema->setPostValidator(
//      new sfValidatorDoctrineUnique(array('model' => 'Role', 'column' => array('name')))
//    );

//    $this->widgetSchema->setNameFormat('role[%s]');

//    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Role';
  }

}
