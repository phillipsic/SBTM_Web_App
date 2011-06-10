<?php

/**
 * Sessions filter form base class.
 *
 * @package    PQASBTM
 * @subpackage filter
 * @author     Mohamed Sithik
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSessionsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'sessionname' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'charter'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'areas'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'testnotes'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ready'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tester'      => new sfWidgetFormFilterInput(),
      'status_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => true)),
      'project_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProjectCategory'), 'add_empty' => true)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'sessionname' => new sfValidatorPass(array('required' => false)),
      'charter'     => new sfValidatorPass(array('required' => false)),
      'areas'       => new sfValidatorPass(array('required' => false)),
      'testnotes'   => new sfValidatorPass(array('required' => false)),
      'ready'       => new sfValidatorPass(array('required' => false)),
      'tester'      => new sfValidatorPass(array('required' => false)),
      'status_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Status'), 'column' => 'id')),
      'project_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProjectCategory'), 'column' => 'id')),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('sessions_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sessions';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'sessionname' => 'Text',
      'charter'     => 'Text',
      'areas'       => 'Text',
      'testnotes'   => 'Text',
      'ready'       => 'Text',
      'tester'      => 'Text',
      'status_id'   => 'ForeignKey',
      'project_id'  => 'ForeignKey',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
