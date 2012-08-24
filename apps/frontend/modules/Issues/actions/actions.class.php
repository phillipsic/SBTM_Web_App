<?php

/**
 * Issues actions.
 *
 * @package    QASBTM
 * @subpackage Issues
 * @author     Gunjan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class IssuesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->issuesList = Doctrine_Core::getTable('Issues')
      ->createQuery('a')
      ->execute();
 }

  public function executeNew(sfWebRequest $request) {

        $this->form = new IssuesForm();
  
    }
  public function executeCreate(sfWebRequest $request)
  {
        $this->forward404Unless($request->isMethod('post'));
        $this->form = new IssuesForm();
        $this->project_id = Doctrine_Core::getTable('ProjectCategory')
                        ->createQuery('a')
                        ->where('a.name = ?', $this->getUser()->getAttribute('project'))
                        ->execute();
        foreach ($this->project_id as $projectid):
            $dbprojectID = $projectid->getId();
        endforeach;
         $this->logMessage("I am before processForm " . $dbprojectID);
        $this->processForm($request, $this->form);
        $this->setTemplate('new');
  }

   public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod('post'));
        $this->form = new IssuesForm();
        $this->project_id = Doctrine_Core::getTable('ProjectCategory')
                        ->createQuery('a')
                        ->where('a.name = ?', $this->getUser()->getAttribute('project'))
                        ->execute();
        foreach ($this->project_id as $projectid):
            $dbprojectID = $projectid->getId();
        endforeach;
         $this->logMessage("I am before processForm " . $dbprojectID);
        $this->processForm($request, $this->form);

    //    $this->setTemplate('Create');
    }
    public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($issues = Doctrine_Core::getTable('Issues')->find(array($request->getParameter('id'))), sprintf('Object Issues does not exist (%s).', $request->getParameter('id')));
    $logins->delete();

    $this->redirect('sbtm/usermysession');
  }

    protected function processForm(sfWebRequest $request, sfForm $form) {
   //     $this->logMessage("I am inside processForm " . $form->getName());
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {

            $issues = $form->save();
            $this->redirect('sbtm/usermysession');
        }
    }
}
