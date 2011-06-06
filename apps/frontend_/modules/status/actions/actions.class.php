<?php

/**
 * status actions.
 *
 * @package    PQASBTM
 * @subpackage status
 * @author     PQASBTM
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class statusActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->statuss = Doctrine_Core::getTable('Status')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->status = Doctrine_Core::getTable('Status')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->status);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new StatusForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new StatusForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($status = Doctrine_Core::getTable('Status')->find(array($request->getParameter('id'))), sprintf('Object status does not exist (%s).', $request->getParameter('id')));
    $this->form = new StatusForm($status);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($status = Doctrine_Core::getTable('Status')->find(array($request->getParameter('id'))), sprintf('Object status does not exist (%s).', $request->getParameter('id')));
    $this->form = new StatusForm($status);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($status = Doctrine_Core::getTable('Status')->find(array($request->getParameter('id'))), sprintf('Object status does not exist (%s).', $request->getParameter('id')));
    $status->delete();

    $this->redirect('status/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $status = $form->save();

      $this->redirect('status/edit?id='.$status->getId());
    }
  }
}
