<?php

/**
 * sbtm actions.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage sbtm
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class autoSbtmActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->roless = Doctrine_Core::getTable('Roles')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->roles = Doctrine_Core::getTable('Roles')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->roles);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new RolesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new RolesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($roles = Doctrine_Core::getTable('Roles')->find(array($request->getParameter('id'))), sprintf('Object roles does not exist (%s).', $request->getParameter('id')));
    $this->form = new RolesForm($roles);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($roles = Doctrine_Core::getTable('Roles')->find(array($request->getParameter('id'))), sprintf('Object roles does not exist (%s).', $request->getParameter('id')));
    $this->form = new RolesForm($roles);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($roles = Doctrine_Core::getTable('Roles')->find(array($request->getParameter('id'))), sprintf('Object roles does not exist (%s).', $request->getParameter('id')));
    $roles->delete();

    $this->redirect('sbtm/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $roles = $form->save();

      $this->redirect('sbtm/edit?id='.$roles->getId());
    }
  }
}
