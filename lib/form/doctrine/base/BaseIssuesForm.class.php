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
abstract class BaseIssuesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $Status_Choice = array('Open' => 'Open','Closed' => 'Closed');
    $this->setWidgets(array(
       'id'       => new sfWidgetFormInputHidden(),
       'creator'       => new sfWidgetFormInputText(),
       'title'         => new sfWidgetFormInputText(),
       'description'   => new sfWidgetFormTextarea(),
      // 'DataFile'      => new sfWidgetFormInputText(),
       'status'        => new sfWidgetFormChoice(array('choices' => $Status_Choice)),
       //'Updated'       => new sfWidgetFormDateTime(),
       'project_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProjectCategory'), 'add_empty' => false)),
   ));
//    $this->widgetSchema->setLabel('id', 'Issue ID');

    $this->setValidators(array(
        'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
       'creator'       => new sfValidatorString(array('max_length' => 255)),
       'title'         => new sfValidatorString(array('max_length' => 255)),
       'description'   => new sfValidatorString(array('max_length' => 800)),
       'status'        => new sfValidatorChoice(array('choices' => array_keys($Status_Choice))),
       //'Updated'       => new sfValidatorDateTime(),
       'project_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProjectCategory'))),
     ));

;

    $this->widgetSchema->setNameFormat('issues[%s]');
    $this->setupInheritance();

    
    parent::setup();
  }

  public function getModelName()
  {
    return 'Issues';
  }

}
