<?php

/**
 * role actions.
 *
 * @package    PQASBTM
 * @subpackage role
 * @author     PQASBTM
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class roleActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->roles = Doctrine_Core::getTable('Role')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->role = Doctrine_Core::getTable('Role')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->role);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new RoleForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new RoleForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($role = Doctrine_Core::getTable('Role')->find(array($request->getParameter('id'))), sprintf('Object role does not exist (%s).', $request->getParameter('id')));
    $this->form = new RoleForm($role);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($role = Doctrine_Core::getTable('Role')->find(array($request->getParameter('id'))), sprintf('Object role does not exist (%s).', $request->getParameter('id')));
    $this->form = new RoleForm($role);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($role = Doctrine_Core::getTable('Role')->find(array($request->getParameter('id'))), sprintf('Object role does not exist (%s).', $request->getParameter('id')));
    $role->delete();

    $this->redirect('role/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $role = $form->save();

      $this->redirect('role/edit?id='.$role->getId());
    }
  }
}
