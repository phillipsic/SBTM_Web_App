<?php

/**
 * sessions actions.
 *
 * @package    QASBTM
 * @subpackage sessions
 * @author     QASBTM
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sessionsActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->sessionss = Doctrine_Core::getTable('Sessions')
                        ->createQuery('a')
                        ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->sessions = Doctrine_Core::getTable('Sessions')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->sessions);
    }

    public function executeNew(sfWebRequest $request) {

        $this->form = new SessionsForm();
        $this->project_id = Doctrine_Core::getTable('ProjectCategory')
                        ->createQuery('a')
                        ->where('a.name = ?', $this->getUser()->getAttribute('project'))
                        ->execute();
        foreach ($this->project_id as $projectid):
            $dbprojectID = $projectid->getId();
        endforeach;
        $this->form->setDefault('status_id', 1);
        $this->form->setDefault('project_id', $dbprojectID);
        $this->form->setDefault('todochange_at', date('Y-m-d H:i:s'));
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new SessionsForm();
        $this->project_id = Doctrine_Core::getTable('ProjectCategory')
                        ->createQuery('a')
                        ->where('a.name = ?', $this->getUser()->getAttribute('project'))
                        ->execute();
        foreach ($this->project_id as $projectid):
            $dbprojectID = $projectid->getId();
        endforeach;
        $this->form->setDefault('status_id', 1);
        $this->form->setDefault('project_id', $dbprojectID);
        $this->form->setDefault('todochange_at', date('Y-m-d H:i:s'));
        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($sessions = Doctrine_Core::getTable('Sessions')->find(array($request->getParameter('id'))), sprintf('Object sessions does not exist (%s).', $request->getParameter('id')));
        $this->form = new SessionsForm($sessions);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($sessions = Doctrine_Core::getTable('Sessions')->find(array($request->getParameter('id'))), sprintf('Object sessions does not exist (%s).', $request->getParameter('id')));
        $this->form = new SessionsForm($sessions);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($sessions = Doctrine_Core::getTable('Sessions')->find(array($request->getParameter('id'))), sprintf('Object sessions does not exist (%s).', $request->getParameter('id')));
      //  $this->logMessage('Page requesting Delete action '.$request ->getParameter('title')));
        $sessions->delete();

       
        if ($request ->getParameter('title')== 'ManageSessions'){
                $proj_id = Doctrine_Core::getTable('ProjectCategory')
                        ->createQuery('a')
                        ->where('a.name = ?', $this->getUser()->getAttribute('project'))
                        ->execute();
                foreach ($proj_id as $projectid):
                    $dbprojectID = $projectid->getId();
                endforeach;
                $this->redirect('sbtm/managesession?id='.$dbprojectID);
        }
        else
                $this->redirect('sbtm/sessions');
    }

    public function executeCancel(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($sessions = Doctrine_Core::getTable('Sessions')->find(array($request->getParameter('id'))), sprintf('Object sessions does not exist (%s).', $request->getParameter('id')));
        $sessions->setStatusId(1);
        $sessions->setTester('');
        $sessions->save();
        $q = Doctrine_Query::create()
                        ->update('Sessions')
                        ->set('todochange_at', 'created_at')
                        ->where('id = ?', $request->getParameter('id'));
        $executequery = $q->fetchArray();
        $this->redirect('sbtm/sessions');
    }

    public function executeStatusready(sfWebRequest $request) {
        $this->ready = $request->getParameter('ready_action');

        for ($i = 0; $i < count($_POST['ids']); $i++) {
            $this->logMessage($_POST['ids'][$i], 'err');
            $this->forward404Unless($sessions = Doctrine_Core::getTable('Sessions')->find(array($_POST['ids'][$i])), sprintf('Object sessions does not exist (%s).', $_POST['ids'][$i]));
            $sessions->setReady($this->ready);
            $sessions->save();
        }
        //$request->checkCSRFProtection();
        $this->project_id = Doctrine_Core::getTable('ProjectCategory')
                        ->createQuery('a')
                        ->where('a.name = ?', $this->getUser()->getAttribute('project'))
                        ->execute();
        foreach ($this->project_id as $projectid):
            $dbprojectID = $projectid->getId();
        endforeach;
        $this->redirect('sbtm/managesession?id=' . $dbprojectID);
    }

    public function executeCopysessions(sfWebRequest $request) {
        $this->project = $request->getParameter('project_action');
        $this->project_id = Doctrine_Core::getTable('ProjectCategory')
                        ->createQuery('a')
                        ->where('a.name = ?', $this->project)
                        ->execute();
        foreach ($this->project_id as $projectid):
            $dbprojectID = $projectid->getId();
        endforeach;
        $this->project_id1 = Doctrine_Core::getTable('ProjectCategory')
                        ->createQuery('a')
                        ->where('a.name = ?', $this->getUser()->getAttribute('project'))
                        ->execute();
        foreach ($this->project_id1 as $projectid1):
            $dbprojectID1 = $projectid1->getId();
        endforeach;
        $q = Doctrine_Query::create()
                        ->update('Sessions')
                        ->set('project_id', $dbprojectID)
                        ->where('status_id=?', '1')
                        ->andwhere('project_id = ?', $dbprojectID1);

        $rows = $q->execute();

//$this->redirect('sbtm/sessionlist');
        $this->redirect('Projectcategory/show?id=' . $this->getUser()->getAttribute('projectid'));
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $params = $request->getParameter($form->getName());
        $userfilename = $params['sessionname'];
        $ses = substr($userfilename, -4);
        if ($ses != ".ses")
            $params['sessionname'] = $userfilename . '.ses';

        $form->bind($params, $request->getFiles($form->getName()));
        if ($form->isValid()) {

            $sessions = $form->save();
            $this->redirect('sbtm/sessions');
            //$this->redirect('sessions/edit?id='.$sessions->getId());
        }
    }

 
    public function executeDownload(sfWebRequest $request) {


        //[Ian]Need to add check here?  Or before we do executeDownload?



        $sessionupdate = Doctrine_Core::getTable('Sessions')->find(array($request->getParameter('id')));
        $usertest = $this->getUser()->getAttribute('username');
        $sessionupdate->setStatusId(3);
        $sessionupdate->setTester($usertest);
        $sessionupdate->save();
        $urlRefresh = "sessions";
        header("Refresh: 1; URL=\"" . $urlRefresh . "\"");
        $dirname = $this->getUser()->getAttribute('project');
        $filename = "uploads/{$dirname}/template";


 
        if (!file_exists($filename)) {
            mkdir("uploads/{$dirname}/template/", 0777, true);
        }
        $filenames = array();
        $filenames[0] = null;
        $source_path = "uploads/{$dirname}/template";
        $dir = realpath($source_path);
        $files = scandir($dir);
        $i = 0;
        foreach ($files as $file) {
            if (substr($file, 0, 1) != '.') {
                $filenames[$i] = $file;
                $i++;
            }
        }
        if ($filenames[0] == null) {
            $source_path = "uploads/template";
            $dir1 = realpath($source_path);
            $fil = scandir($dir1);
            $i1 = 0;
            foreach ($fil as $fi) {
                if (substr($fi, 0, 1) != '.') {
                    $filenames[$i1] = $fi;
                    $i1++;
                }
            }
        }
        $this->logMessage($filenames[0] . 'filename');
        $linebreaker = "\n";

        $this->sessions = Doctrine::getTable('Sessions')->find($request->getParameter('id'));
        $filename = $this->sessions->getSessionname();
        $myFile = $this->sessions->getFileSlug();
        $templateFile = $source_path . '/' . $filenames[0];
        copy($templateFile, $myFile);
        $this->logMessage($templateFile . $myFile);
        $fh = fopen($myFile, 'r') or die("can't open file");

        $char = "/^CHARTER/i";
        $area = "/AREAS/i";
        $testnotes = "/TEST NOTES/i";

        $stringData = "";
        while (!feof($fh)) {
            $line = fgets($fh);
            if (preg_match($char, $line)) {
                $stringData.=$line;
                $stringData.=fgets($fh);
                $stringData.=$this->sessions->getCharter() . $linebreaker;
            } else if (preg_match($area, $line)) {
                $stringData.=$line;
                $stringData.=fgets($fh);
                $stringData.=str_replace(";", $linebreaker, $this->sessions->getAreas()) . $linebreaker;
            } else if (preg_match($testnotes, $line)) {
                $stringData.=$line;
                $stringData.=fgets($fh);
                $stringData.=$this->sessions->getTestnotes() . $linebreaker;
            }
            else
                $stringData.=$line;
        }
        //$this->logMessage( $stringData.'sithik');
        $fh1 = fopen($myFile, 'w') or die("can't open file");
        fwrite($fh1, $stringData);
        //$count = $this->sessions->columnCount()."\n";
        //for ( $column = 0; $counter <= $count; $column++) {
        // fwrite($fh, $this->sessions->get($column+1));
        // }
        fclose($fh);
        fclose($fh1);
        $response = $this->getContext()->getResponse();
        $response->clearHttpHeaders();
        $response->addCacheControlHttpHeader('Cache-control', 'must-revalidate, post-check=0, pre-check=0');
        $response->setContentType('application/octet-stream', true);
        $response->setHttpHeader('Content-transfer-encoding', 'binary');
        $response->setHttpHeader('Content-Disposition', 'attachement; filename=' . $this->sessions->getFileSlug());
        $response->sendHttpHeaders();
        $response->setContent(file_get_contents('./' . $myFile, true));
        unlink('./' . $myFile);



        return sfView::NONE;
    }

    public function executeUpload(sfWebRequest $request) {

        $this->project_id = Doctrine_Core::getTable('ProjectCategory')
                        ->createQuery('a')
                        ->where('a.name = ?', $this->getUser()->getAttribute('project'))
                        ->execute();
        foreach ($this->project_id as $projectid):
            $dbprojectID = $projectid->getId();
        endforeach;
        $target_path = "uploads/";
        $target_path = $target_path . basename($_FILES['uploadedfile']['name']);

        if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
            $myFile = "uploads/todo.csv";
            $fh = fopen($myFile, 'r');
            $this->strategy_id = Doctrine_Core::getTable('Strategy')
                            ->createQuery('a')
                            ->execute();
            $theData = fgets($fh);
            while (!feof($fh)) {
                $theData = fgets($fh);
                list($sessionname, $charter, $areas, $startegy) = split('[,]', $theData);

                $this->logMessage('abcde');
                foreach ($this->strategy_id as $strategyid):
                    // $this->logMessage('abcd'.$strategyid->getId());
                    if ($strategyid->getName() == trim($startegy)) {
                        $this->logMessage($strategyid->getId() . 'sithik12' . $startegy);
                        $statID = $strategyid->getId();
                    }
                endforeach;
                
                $newsessionname = str_replace(array("&", "*"," ","?"),"_",$sessionname);

                $sessioninsert = new Sessions();
                $sessioninsert->setSessionname($newsessionname . '.ses');
                $sessioninsert->setCharter($charter);
                $sessioninsert->setAreas($areas);
//$sessioninsert->setTestnotes($testnotes);
                $sessioninsert->setReady('No');
                $sessioninsert->setTester('');
                $sessioninsert->setStatusId(1);
                $sessioninsert->setProjectId($dbprojectID);
                $sessioninsert->setStrategyId($statID);
                $sessioninsert->setTodochangeAt(date('Y-m-d H:i:s'));
                $sessioninsert->save();
            }
            fclose($fh);


            $this->getUser()->setAttribute('loadedmessage', 'The file ' . basename($_FILES['uploadedfile']['name']) . 'has been uploaded');
        } else {
            $this->getUser()->setAttribute('loadedmessage', 'There was an error uploading the file, please try again! ');
        }



        $this->redirect('sbtm/managesession');
    }

    public function executeUploads() {

    }

    public function executeReview(sfWebRequest $request) {
        $dirname = $this->getUser()->getAttribute('project');
        $final = $request->getParameter('final');
        $this->getUser()->setAttribute('final', $final);
        $this->status = Doctrine_Core::getTable('Status')
                        ->createQuery('a')
                        ->execute();

        $name = sbtm::slugify($request->getParameter('name'));
        $this->getUser()->setAttribute('filename', $name);
        $this->getUser()->setAttribute('filename1', $request->getParameter('name'));
        $this->getUser()->setAttribute('id', $request->getParameter('id'));
        $this->getUser()->setAttribute('url', 'sessions/review?name=' . $request->getParameter('name') . '&id=' . $request->getParameter('id') . '&final=yes');
        $myFile = "uploads/{$dirname}/" . $name;
        $this->logMessage($myFile, 'err');
        $theData = file_get_contents($myFile);
        $this->getUser()->setAttribute('theData', $myFile);
        $this->logMessage($theData, 'err');
    }

    public function executeSessionreadonly(sfWebRequest $request) {
        $dirname = $this->getUser()->getAttribute('project');
        $this->status = Doctrine_Core::getTable('Status')
                        ->createQuery('a')
                        ->execute();
        $name = sbtm::slugify($request->getParameter('name'));
        $this->getUser()->setAttribute('filename', $name);
        $this->getUser()->setAttribute('id', $request->getParameter('id'));
        $myFile = "uploads/{$dirname}/" . $name;
        $this->logMessage($myFile, 'err');
        $theData = file_get_contents($myFile);
        $this->getUser()->setAttribute('theData', $myFile);
        $this->logMessage($theData, 'err');
    }

}
