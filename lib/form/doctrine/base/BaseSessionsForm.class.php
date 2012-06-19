<?php

/**
 * Sessions form base class.
 *
 * @method Sessions getObject() Returns the current form's model object
 *
 * @package    QASBTM
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
      'testnotes'   => new sfWidgetFormTextarea(),
      'ready'       => new sfWidgetFormInputText(),
  //    'tester'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Logins'), 'add_empty' => true)),
      'status_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => false)),
      'project_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProjectCategory'), 'add_empty' => false)),
      'strategy_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Strategy'), 'add_empty' => false)),
  //    'created_at'  => new sfWidgetFormDateTime(),
  //    'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'sessionname' => new sfValidatorString(array('max_length' => 255)),
      'charter'     => new sfValidatorString(array('max_length' => 255)),
      'areas'       => new sfValidatorString(array('max_length' => 800)),
      'testnotes'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ready'       => new sfValidatorString(array('max_length' => 255)),
    //  'tester'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Logins'),'required' => false)),
      'status_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Status'))),
      'project_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ProjectCategory'))),
      'strategy_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Strategy'))),
    //  'created_at'  => new sfValidatorDateTime(),
    //  'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Sessions', 'column' => array('sessionname')))
    );

    $this->widgetSchema->setNameFormat('sessions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setValidator('sessionname', new sfValidatorRegex(array('pattern' => '/^[-A-z0-9_. ]*$/i'),
        array('invalid' => 'Your Session Name can only have letters (A-Z),numbers (0-9) or an underscore(_) .'))
            );

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sessions';
  }

}
