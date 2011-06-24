<?php

/**
 * Sessions form base class.
 *
 * @method Sessions getObject() Returns the current form's model object
 *
 * @package    PQASBTM
 * @subpackage form
 * @author     Mohamed Sithik
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSessionsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'sessionname' => new sfWidgetFormInputText(),
      'charter'     => new sfWidgetFormInputText(),
      'areas'       => new sfWidgetFormTextarea(),
      'testnotes'   => new sfWidgetFormInputText(),
      'ready'    => new sfWidgetFormChoice(array('choices' => $choices = array(
    'Yes' => 'Yes',
    'No'     => 'No',
  ))),
      'tester'      => new sfWidgetFormInputText(),
      //'status_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => false)),
      //'project_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProjectCategory'), 'add_empty' => false)),
      'status_id'   =>  new sfWidgetFormInputHidden(),
       'project_id'  => new sfWidgetFormInputHidden(),
      'strategy_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Strategy'), 'add_empty' => false)),
      //'created_at'  => new sfWidgetFormDateTime(),
     // 'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'sessionname' => new sfValidatorString(array('max_length' => 255)),
      'charter'     => new sfValidatorString(array('max_length' => 255)),
      'areas'       => new sfValidatorString(array('max_length' => 800)),
      'testnotes'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ready'       => new sfValidatorString(array('max_length' => 255)),
      'tester'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'status_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Status'))),
      'project_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProjectCategory'))),
      'strategy_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Strategy'))),
      //'created_at'  => new sfValidatorDateTime(),
     // 'updated_at'  => new sfValidatorDateTime(),
    ));
$this->widgetSchema->setHelp('tester', 'You can assign the session to the User, If not leave it blank');
    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Sessions', 'column' => array('sessionname')))
    );

    $this->widgetSchema->setNameFormat('sessions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sessions';
  }

}
