<?php

/**
 * sbtm actions.
 *
 * @package    PQASBTM
 * @subpackage sbtm
 * @author     PQASBTM
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sbtmActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->project_category = Doctrine_Core::getTable('ProjectCategory')
      ->createQuery('a')
     ->execute();

  }

  public function executeReporting(sfWebRequest $request)
  {

  }
  public function executeBurndownchart(sfWebRequest $request)
  {
      $response = $this->getResponse();

    // HTTP headers
    $response->setContentType('image/png');


  }


  public function executeLogout(sfWebRequest $request)
  {
   $this->getUser()->getAttributeHolder()->clear();
  $this->redirect('sbtm/index');
  }

  public function executeProjectadmin(sfWebRequest $request)
  {

   $this->project_category = Doctrine_Core::getTable('ProjectCategory')
      ->createQuery('a')
      ->execute();
  }

  public function executeUseradmin(sfWebRequest $request)
  {

   $this->users = Doctrine_Core::getTable('Logins')
      ->createQuery('a')
     ->execute();
  }

  public function executeSessions(sfWebRequest $request)
  {
      $this->project_id = Doctrine_Core::getTable('ProjectCategory')
      ->createQuery('a')
      ->where('a.name = ?',$this->getUser()->getAttribute('project') )
     ->execute();
           foreach ($this->project_id as $projectid):
           $dbprojectID =$projectid->getId();
           endforeach;
   $this->sessions = Doctrine_Core::getTable('Sessions')
      ->createQuery('a')
           ->where('a.project_id = ?',$dbprojectID)
           ->andWhereIn('a.status_id',array(1))
                         ->andWhere('a.ready= ?','Yes')
           //->where('a.ready=?','yes')
     ->execute();
  }
  public function executeUserdetail(sfWebRequest $request)
  {

   $this->userdetail = Doctrine_Core::getTable('Logins')
      ->createQuery('a')
     ->where('a.id = ?',$request->getParameter('id'))
     ->execute();
  }

  public function executeLogin(sfWebRequest $request)
  {

    $this->user = $request->getParameter('username');
    $this->pass = $request->getParameter('password');
    $this->project = $request->getParameter('project_action');
    $this->getUser()->setAttribute('username', $this->user);
    $this->getUser()->setAttribute('project', $this->project);
    $this->logins = Doctrine_Core::getTable('Logins')
           ->createQuery('l')
           ->where('l.username = ?',$this->user )
           ->execute();
    foreach ($this->logins as $login):
    $dbuser=$login->getUsername();
    $dbpass=$login->getPassword();
    $dbrole=$login->getRole();
    $dblock=$login->getIslocked();
    endforeach;
     $this->getUser()->setAttribute('adminrole', $dbrole);

    if($this->user==$dbuser && $this->pass==$dbpass && $this->project != ""){
        $this->getUser()->setAttribute('logindone', 'logindone');
        if($dblock!=''){
        $this->getUser()->setAttribute('error', 'User '.$this->user.' locked please contact administrator');
        $this->redirect('sbtm/index');
}

        if($this->project=="newproject" && $dbrole=="Admin"){

            $this->redirect('ProjectCategory/new');
        }
        if($this->project=="newproject" && $dbrole=="User"){
           $this->getUser()->setAttribute('error', 'User '.$this->user.' not allowed to create a new project');
            $this->redirect('sbtm/index');
        }


        }
    else{
        $this->getUser()->setAttribute('error', 'Username/Password not Valid');
        $this->redirect('sbtm/index');

        }

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

    $this->redirect('sbtm/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $logins = $form->save();

      $this->redirect('sbtm/edit?id='.$logins->getId());
    }
  }

  public function executeUpload(sfWebRequest $request)
{
       $dirname = $this->getUser()->getAttribute('project'); 
    $filename = "uploads/{$dirname}/"; 
    
    if (!file_exists($filename)) { 
       mkdir("uploads/{$dirname}", 0777); 
        echo "The directory {$dirname} was successfully created."; 
    } 
      
$target_path = "uploads/{$dirname}/";
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
     $sessionupdate = Doctrine_Core::getTable('Sessions')->find(array($this->getUser()->getAttribute('id')));
      $usertest=$this->getUser()->getAttribute('username');
      $sessionupdate->setStatusId('2');
      $sessionupdate->setTester($usertest);
      $sessionupdate->save();
      $urlRefresh = "sessions";
      header("Refresh: 1; URL=\"" . $urlRefresh . "\"");
    $this->getUser()->setAttribute('uploadmessage', 'The file '.  basename( $_FILES['uploadedfile']['name']).'has been uploaded');
} else{
    $this->getUser()->setAttribute('uploadmessage', 'There was an error uploading the file, please try again! ');
}



$this->redirect('sbtm/sessions');
}
 public function executeUploads(sfWebRequest $request)
{
$this->getUser()->setAttribute('id',$request->getParameter('id'));
}

 public function executeUsermysession(sfWebRequest $request)
  {
     $this->project_id = Doctrine_Core::getTable('ProjectCategory')
      ->createQuery('a')
              ->where('a.name = ?',$this->getUser()->getAttribute('project') )
     ->execute();
foreach ($this->project_id as $projectid):
   $dbprojectID =$projectid->getId();
endforeach;
   $this->sessions = Doctrine_Core::getTable('Sessions')
      ->createQuery('a')
           ->where('a.tester = ?',$this->getUser()->getAttribute('username'))
                   ->andWhere('a.project_id = ?',$dbprojectID)
           ->andWhereIn('a.status_id',array(3,5))
           //->where('a.ready=?','yes')
     ->execute();
  }


public function executeAdminmysession(sfWebRequest $request)
  {
     $this->project_id = Doctrine_Core::getTable('ProjectCategory')
      ->createQuery('a')
              ->where('a.name = ?',$this->getUser()->getAttribute('project') )
     ->execute();
foreach ($this->project_id as $projectid):
   $dbprojectID =$projectid->getId();
endforeach;
   $this->sessions = Doctrine_Core::getTable('Sessions')
      ->createQuery('a')
           ->where('a.tester != ?','')
           ->andWhere('a.status_id=?','2')
           ->andWhere('a.project_id = ?',$dbprojectID)
     ->execute();
  }


  public function executeReviewsubmit(sfWebRequest $request)
{
      $dirname = $this->getUser()->getAttribute('project'); 
      $target_path = "uploads/{$dirname}/";
$target_path = $target_path . $this->getUser()->getAttribute('filename');

if(file_put_contents($target_path, $request->getParameter('quote'))) {
    $stat_id=Doctrine_Core::getTable('Status')
    ->createQuery('a')
           ->where('a.name = ?',$request->getparameter('status_action'))
            ->execute();
    
    foreach ($stat_id as $statid):
   $dbstatID =$statid->getId();
endforeach;
$this->logMessage($request->getparameter('status_action').'sithik'.$dbstatID);
    $sessionupdate = Doctrine_Core::getTable('Sessions')->find(array($this->getUser()->getAttribute('id')));
      $usertest=$this->getUser()->getAttribute('username');
      $sessionupdate->setStatusId($dbstatID);
      //$sessionupdate->setTester($usertest);
      $sessionupdate->save();
      $urlRefresh = "sessions";
      header("Refresh: 1; URL=\"" . $urlRefresh . "\"");
    $this->getUser()->setAttribute('uploadmessage', 'The file '.  basename( $_FILES['uploadedfile']['name']).'has been uploaded');
} else{
    $this->getUser()->setAttribute('uploadmessage', 'There was an error uploading the file, please try again! ');
}



$this->redirect('sbtm/adminmysession');
}


public function executeSessionlist(sfWebRequest $request)
  {
    $this->project_id = Doctrine_Core::getTable('ProjectCategory')
      ->createQuery('a')
              ->where('a.name = ?',$this->getUser()->getAttribute('project') )
     ->execute();
foreach ($this->project_id as $projectid):
   $dbprojectID =$projectid->getId();
endforeach;
    $this->approved_sessions = Doctrine_Core::getTable('Sessions')
      ->createQuery('a')
            ->where('a.status_id=?','4')
            ->andWhere('a.project_id = ?',$dbprojectID)
     ->execute();
    
    
    $this->progress_sessions = Doctrine_Core::getTable('Sessions')
      ->createQuery('a')
            ->where('a.status_id!=?','4')
            ->andWhere('a.project_id = ?',$dbprojectID)
     ->execute();

  }

public function executeManagesession(sfWebRequest $request)
  {$this->getUser()->setAttribute('dropid',$request->getparameter('id'));
     $this->sessions = Doctrine_Core::getTable('Sessions')
      ->createQuery('a')
           ->where('a.project_id = ?',$request->getparameter('id'))
     ->execute();
  }
}
