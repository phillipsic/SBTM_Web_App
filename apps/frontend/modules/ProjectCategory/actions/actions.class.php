<?php

/**
 * ProjectCategory actions.
 *
 * @package    PQASBTM
 * @subpackage ProjectCategory
 * @author     PQASBTM
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProjectCategoryActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->project_categorys = Doctrine_Core::getTable('ProjectCategory')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->project_category = Doctrine_Core::getTable('ProjectCategory')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->project_category);
    
 $this->project_id = Doctrine_Core::getTable('ProjectCategory')
      ->createQuery('a')
              ->where('a.name = ?',$this->getUser()->getAttribute('project') )
     ->execute();
foreach ($this->project_id as $projectid):
   $dbprojectID =$projectid->getId();
endforeach;

    
    $this->progress_sessions = Doctrine_Core::getTable('Sessions')
      ->createQuery('a')
            ->where('a.status_id!=?','4')
            ->andWhere('a.project_id = ?',$dbprojectID)
     ->execute();   
    $this->project_category1 = Doctrine_Core::getTable('ProjectCategory')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ProjectCategoryForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ProjectCategoryForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
    //$this->redirect('sbtm/projectadmin');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($project_category = Doctrine_Core::getTable('ProjectCategory')->find(array($request->getParameter('id'))), sprintf('Object project_category does not exist (%s).', $request->getParameter('id')));
    $this->form = new ProjectCategoryForm($project_category);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($project_category = Doctrine_Core::getTable('ProjectCategory')->find(array($request->getParameter('id'))), sprintf('Object project_category does not exist (%s).', $request->getParameter('id')));
    $this->form = new ProjectCategoryForm($project_category);

    $this->processForm($request, $this->form);

    //$this->setTemplate('edit');
     //$this->redirect('sbtm/projectadmin');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($project_category = Doctrine_Core::getTable('ProjectCategory')->find(array($request->getParameter('id'))), sprintf('Object project_category does not exist (%s).', $request->getParameter('id')));
    $project_category->delete();

    $this->redirect('sbtm/projectadmin');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $project_category = $form->save();
if($this->getUser()->getAttribute('new')=='yes'){
          $this->getUser()->setAttribute('project',$form->getValue('name'));
          $this->getUser()->getAttributeHolder()->remove('new');
          }
//                   $this->logMessage($val.'sithik'.$form->getValue('name'), 'err');
  

      $this->redirect('ProjectCategory/show?id='.$this->getUser()->getAttribute('projectid'));
      //$this->redirect('ProjectCategory/edit?id='.$project_category->getId());
    }
  }
}
