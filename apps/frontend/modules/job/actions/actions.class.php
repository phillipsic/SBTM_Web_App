<?php

/**
 * job actions.
 *
 * @package    PQASBTM
 * @subpackage job
 * @author     PQASBTM
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class jobActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    //$this->loginss = Doctrine_Core::getTable('Logins')
      //->createQuery('a')
     //->execute();
    $this->project_category = Doctrine_Core::getTable('ProjectCategory')
      ->createQuery('a')
     ->execute();
  }
  public function executeHome(sfWebRequest $request)
  {
      
    $this->userName = $request->getParameter('username');
    $this->passWord = $request->getParameter('password');
    $this->project = $request->getParameter('project');
    $this->loginss = Doctrine_Core::getTable('Logins')
      ->createQuery('a')
       ->execute();
  
  }
  public function executeLogout(sfWebRequest $request)
  {
   
  $this->redirect('job/index');
  }
  
  public function executeProjectadmin(sfWebRequest $request)
  {
   $this->userName = $request->getParameter('username');
   $this->project = $request->getParameter('project');
   $this->project_category = Doctrine_Core::getTable('ProjectCategory')
      ->createQuery('a')
     ->execute();
  }
  
  public function executeLogin(sfWebRequest $request)
  {
    $this->user = $request->getParameter('username');
    $this->pass = $request->getParameter('password');
    $this->project = $request->getParameter('project_action');
    $this->logins = Doctrine_Core::getTable('Logins')
           ->createQuery('l')
           ->where('l.username = ?', $this->user)
           ->execute();
  
    if($this->user=="sithik" && $this->pass=="sithik123"){
     //if($this->user==$logins->username && $this->pass==$logins->password){
        $this->redirect('job/home?username='.$this->user.'&password='.$this->pass.'&project='.$this->project);}
    else{
        $this->redirect('job/index?flag=true');}
   // $flag= $this->logins->getTable()->find(array($request->getParameter('username')));
   //$this->forward404Unless($flag, sprintf('User does not exist (%s).', $request->getParameter('username')));
   
   /*foreach ($this->logins as $user) {
            $request->setAttribute("admin",$user->status); 
       if(($user->username==$this->user) && ($user->password==$this->pass)) {        
  
         }
       else{
          $this->redirect('job/login'); 
       }
                   }*/
   
   }
  

  public function executeShow(sfWebRequest $request)
  {
    $this->logins = Doctrine_Core::getTable('Logins')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->logins);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new LoginsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new LoginsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($logins = Doctrine_Core::getTable('Logins')->find(array($request->getParameter('id'))), sprintf('Object logins does not exist (%s).', $request->getParameter('id')));
    $this->form = new LoginsForm($logins);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($logins = Doctrine_Core::getTable('Logins')->find(array($request->getParameter('id'))), sprintf('Object logins does not exist (%s).', $request->getParameter('id')));
    $this->form = new LoginsForm($logins);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($logins = Doctrine_Core::getTable('Logins')->find(array($request->getParameter('id'))), sprintf('Object logins does not exist (%s).', $request->getParameter('id')));
    $logins->delete();

    $this->redirect('job/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $logins = $form->save();

      $this->redirect('job/edit?id='.$logins->getId());
    }
  }
  
  
  
  
}
