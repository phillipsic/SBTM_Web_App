<?php

/**
 * ProjectCategory form base class.
 *
 * @method ProjectCategory getObject() Returns the current form's model object
 *
 * @package    PQASBTM
 * @subpackage form
 * @author     PQASBTM
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProjectCategoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInputText(),
      'startdate'   => new sfWidgetFormDate(),
      'enddate'     => new sfWidgetFormDate(),
      'completetag' => new sfWidgetFormInputCheckbox(array('value_attribute_value' => 1)),
        //// 'created_at' => new sfWidgetFormDateTime(),
     // 'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 255)),
      'startdate'   => new sfValidatorDate(array('required' => false)),
      'enddate'     => new sfValidatorDate(array('required' => false)),
      'completetag' => new sfValidatorBoolean(),
      // 'created_at' => new sfValidatorDateTime(),
     // 'updated_at' => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'ProjectCategory', 'column' => array('name')))
    );
    
    $this->widgetSchema->setNameFormat('project_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProjectCategory';
  }

}
