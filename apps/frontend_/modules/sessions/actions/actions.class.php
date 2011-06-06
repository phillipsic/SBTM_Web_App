<?php

/**
 * sessions actions.
 *
 * @package    PQASBTM
 * @subpackage sessions
 * @author     PQASBTM
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sessionsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->sessionss = Doctrine_Core::getTable('Sessions')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->sessions = Doctrine_Core::getTable('Sessions')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->sessions);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SessionsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SessionsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($sessions = Doctrine_Core::getTable('Sessions')->find(array($request->getParameter('id'))), sprintf('Object sessions does not exist (%s).', $request->getParameter('id')));
    $this->form = new SessionsForm($sessions);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($sessions = Doctrine_Core::getTable('Sessions')->find(array($request->getParameter('id'))), sprintf('Object sessions does not exist (%s).', $request->getParameter('id')));
    $this->form = new SessionsForm($sessions);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($sessions = Doctrine_Core::getTable('Sessions')->find(array($request->getParameter('id'))), sprintf('Object sessions does not exist (%s).', $request->getParameter('id')));
    $sessions->delete();

    $this->redirect('sessions/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $sessions = $form->save();

      $this->redirect('sessions/edit?id='.$sessions->getId());
    }
  }
}
