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
    


  }
  
  public function executeLineChartData()
  {
    srand((double)microtime()*1000000);

//
// NOTE: how we are filling 3 arrays full of data,
//       one for each line on the graph
//
$data_1 = array();
$data_2 = array();
$data_3 = array();
for( $i=0; $i<12; $i++ )
{
  $data_1[] = rand(14,19);
  $data_2[] = rand(8,13);
  $data_3[] = rand(1,7);
}

$g = new stGraph();
$g->title( $this->getUser()->getAttribute('project'), '{font-size: 20px; color: #736AFF}' );

// we add 3 sets of data:
$g->set_data( $data_1 );
$g->set_data( $data_2 );
$g->set_data( $data_3 );

// we add the 3 line types and key labels
$g->line( 3, '0x9933CC', 'Todo', 10 );
$g->line_dot( 3, 4, '0xCC3399', 'Total', 10);    // <-- 3px thick + dots
$g->line_hollow( 3, 4, '0x80a033', 'Target', 10 );

$g->set_x_labels( array( 'January','February','March','April','May','June','July','August','Spetember','October','November','December' ) );
$g->set_x_label_style( 10, '0x000000', 0, 2 );

$g->set_y_max( 25 );
$g->y_label_steps( 5 );
$g->set_y_legend( 'Sessions', 12, '#736AFF' );
echo $g->render();

return sfView::NONE;
  }
public function executePieChartData()
	{
		$chatData = array();
		/*for( $i = 0; $i < 3; $i++ )
		{
			$data[] = rand(5,20);
		}*/
$todosessions = Doctrine_Core::getTable('Sessions')
                 ->createQuery('a')
                 ->where('a.status_id = 1')
                 ->andWhereIn('a.updated_dt < sysdate ')
                 ->execute();
$this->logMessage($todosessions->count().'Count');
$data[0]=$todosessions->count();
$data[1]=$todosessions->count();
$data[2]=$todosessions->count();
		//Creating a stGraph object		
		$g = new stGraph();

		//set background color
		$g->bg_colour = '#E4F5FC';

		//Set the transparency, line colour to separate each slice etc.
		$g->pie(80,'#78B9EC','{font-size: 12px; color: #78B9EC;');

		//array two arrray one containing data while other contaning labels 
		$g->pie_values($data, array('Todo','Total','Target'));
		
		//Set the colour for each slice. Here we are defining three colours 
		//while we need 7 colours. So, the same colours will be 
		//repeated for the all remaining slices in the same order  
		$g->pie_slice_colours( array('#d01f3c','#356aa0','#c79810') );

		//To display value as tool tip
		$g->set_tool_tip( '#val#%' );

		$g->title( $this->getUser()->getAttribute('project'), '{font-size:18px; color: #18A6FF}' );
		echo $g->render();
		return sfView::NONE;
	}

  public function executeLogout(sfWebRequest $request)
  {
      $this->getUser()->setAuthenticated(false);
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
            $this->getUser()->setAuthenticated(false);
        $this->getUser()->setAttribute('error', 'User '.$this->user.' locked please contact administrator');
        $this->redirect('sbtm/index');
}

        if($this->project=="newproject" && $dbrole=="Admin"){
            $this->getUser()->setAuthenticated(true);
            $this->getUser()->setAttribute('new','yes');
            $this->redirect('ProjectCategory/new');
        }
        if($this->project=="newproject" && $dbrole=="User"){
            $this->getUser()->setAuthenticated(false);
           $this->getUser()->setAttribute('error', 'User '.$this->user.' not allowed to create a new project');
            $this->redirect('sbtm/index');
        }
        else{

            $this->getUser()->setAuthenticated(true);
            
            }


        }
    else{
        if($this->project == ""){
            $this->getUser()->setAttribute('error', 'Please select the Project');
        }
        else {$this->getUser()->setAttribute('error', 'Username/Password not Valid');}
        $this->getUser()->setAuthenticated(false);
        
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
$sessionupdate = Doctrine_Core::getTable('Sessions')->find(array($this->getUser()->getAttribute('id')));
//$this->logMessage($sessionupdate->getSessionname().'sithik'.basename( $_FILES['uploadedfile']['name']));
$name=sbtm::slugify($sessionupdate->getSessionname());
if($name==basename( $_FILES['uploadedfile']['name'])){
$this->getUser()->getAttributeHolder()->remove('error');

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
     
      $usertest=$this->getUser()->getAttribute('username');
      $sessionupdate->setStatusId('5');
      $sessionupdate->setTester($usertest);
      $sessionupdate->save();
      $urlRefresh = "sessions";
      header("Refresh: 1; URL=\"" . $urlRefresh . "\"");
    $this->getUser()->setAttribute('uploadmessage', 'The file '.  basename( $_FILES['uploadedfile']['name']).'has been uploaded');
    //$this->getUser()->setAttribute('final','final');
} else{
    $this->getUser()->setAttribute('uploadmessage', 'There was an error uploading the file, please try again! ');
}
$this->redirect('sbtm/usermysession');
}
else{
    $this->getUser()->setAttribute('error', 'File name '.basename( $_FILES['uploadedfile']['name']).' not matched with the session');
   $this->redirect('sbtm/uploads?id='.$this->getUser()->getAttribute('id')); 
}



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


if($this->getUser()->getAttribute('final')=='yes')
$this->redirect('sbtm/usermysession');
else
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
  {
    $this->getUser()->setAttribute('dropid',$request->getparameter('id'));
    
    $this->project_id = Doctrine_Core::getTable('ProjectCategory')
      ->createQuery('a')
              ->where('a.id = ?',$request->getparameter('id') )
     ->execute();
foreach ($this->project_id as $projectid):
   $dbprojectID =$projectid->getName();
$this->getUser()->setAttribute('projectname',$dbprojectID);
endforeach;

     $this->sessions = Doctrine_Core::getTable('Sessions')
      ->createQuery('a')
           ->where('a.project_id = ?',$request->getparameter('id'))
     ->execute();
  }
}
