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

    //$this->setTemplate('new');
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

    //$this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($sessions = Doctrine_Core::getTable('Sessions')->find(array($request->getParameter('id'))), sprintf('Object sessions does not exist (%s).', $request->getParameter('id')));
    $sessions->delete();

    $this->redirect('sbtm/sessions');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $sessions = $form->save();
       $this->redirect('sbtm/sessions');
      //$this->redirect('sessions/edit?id='.$sessions->getId());
    }
  }

  public function executeDownload(sfWebRequest $request) {
      
      $sessionupdate = Doctrine_Core::getTable('Sessions')->find(array($request->getParameter('id')));
      $usertest=$this->getUser()->getAttribute('username');
      $sessionupdate->setStatusId('3');
      $sessionupdate->setTester($usertest);
      $sessionupdate->save();
      $urlRefresh = "sessions";
      header("Refresh: 1; URL=\"" . $urlRefresh . "\"");
            
      $linebreaker="\n";
      $extra="-----------------------------------------------";
      $chart="CHARTER";
      $area="AREAS";
      $start="START";
      $tester="TESTER";
      $task="TASK BREAKDOWN";
      $bugs="BUGS";
      $issues="ISSUES";
      $testnotes="TEST NOTES";
      $datafile="DATA FILES";
      $taskcontent="#DURATION
#TEST DESIGN AND EXECUTION
#BUG INVESTIGATION AND REPORTING
#SESSION SETUP
#CHARTER VS. OPPORTUNITY
100/0";
      $testnotescontent="Build Number -
                         PQA Environment -
                         Document passed and failed tests
                         Assessment of quality? 
                         What was not tested?";
      $notapp="N/A";
	    $this->sessions = Doctrine::getTable('Sessions')->find($request->getParameter('id'));
            $filename=$this->sessions->getSessionname();
            $myFile = $this->sessions->getFileSlug();
            $fh = fopen($myFile, 'w') or die("can't open file");
            $stringData = $chart.$linebreaker.$extra.$linebreaker.
            $this->sessions->getCharter().$linebreaker.$linebreaker.
                    $area.$linebreaker.$extra.$linebreaker.
            $this->sessions->getAreas().$linebreaker.$linebreaker.
                    $start.$linebreaker.$extra.$linebreaker.
            $linebreaker.$linebreaker.
                    $tester.$linebreaker.$extra.$linebreaker.
            $linebreaker.$linebreaker.
                    $task.$linebreaker.$extra.$linebreaker.
            $taskcontent.$linebreaker.$linebreaker.
                    $datafile.$linebreaker.$extra.$linebreaker.
            $notapp.$linebreaker.$linebreaker.
                    $testnotes.$linebreaker.$extra.$linebreaker.
            $this->sessions->getTestnotes().$linebreaker.$linebreaker.
                    $bugs.$linebreaker.$extra.$linebreaker.
            $notapp.$linebreaker.$linebreaker.
                    $issues.$linebreaker.$extra.$linebreaker.
            $notapp;
            fwrite($fh, $stringData);
            $count = $this->sessions->columnCount()."\n";
            //for ( $column = 0; $counter <= $count; $column++) {
           // fwrite($fh, $this->sessions->get($column+1));
           // }
            fclose($fh);
	    $response = $this->getContext()->getResponse();
	    $response->clearHttpHeaders();
	    $response->addCacheControlHttpHeader('Cache-control', 'must-revalidate, post-check=0, pre-check=0');
	    $response->setContentType('application/octet-stream', true);
	    $response->setHttpHeader('Content-transfer-encoding', 'binary');
	    $response->setHttpHeader('Content-Disposition', 'attachement; filename=' . $this->sessions->getFileSlug() );
	    $response->sendHttpHeaders();
	    $response->setContent(file_get_contents('./'.$myFile, true));
            unlink('./'.$myFile);
            
            

	    return sfView::NONE;
            
            
	}
        
        
public function executeUpload(sfWebRequest $request)
{
$target_path = "uploads/";
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
$myFile = "uploads/sessions.txt";
$fh = fopen($myFile, 'r');
while(! feof($fh))
  {
$theData = fgets($fh);
list($sessionname, $charter, $areas,$testnotes,$ready,$tester,$statusid) = split('[&]', $theData);
$sessioninsert = new Sessions();
$sessioninsert->setSessionname($sessionname);
$sessioninsert->setCharter($charter);
$sessioninsert->setAreas($areas);
$sessioninsert->setTestnotes($testnotes);
$sessioninsert->setReady($ready);
$sessioninsert->setTester($tester);
$sessioninsert->setStatusId($statusid);
$sessioninsert->save();
  }
fclose($fh);

    
    $this->getUser()->setAttribute('loadedmessage', 'The file '.  basename( $_FILES['uploadedfile']['name']).'has been uploaded');
} else{
    $this->getUser()->setAttribute('loadedmessage', 'There was an error uploading the file, please try again! ');
}

        
        
$this->redirect('sbtm/sessions');    
}

public function executeUploads()
{

}
        
}
