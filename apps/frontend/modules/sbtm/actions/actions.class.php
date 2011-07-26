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
  
  public function executeManagecoverage(sfWebRequest $request)
  {
     
   $dirname = $this->getUser()->getAttribute('project'); 
   $this->logMessage($dirname.'directory name');
    $filename = "uploads/{$dirname}/coverage"; 
    if (!file_exists($filename)) { 
       mkdir("uploads/{$dirname}/coverage/", 0777); 
        } 
    $filenames=array();
$source_path = "uploads/{$dirname}/coverage";
    $dir = realpath($source_path);
$files = scandir($dir);
$i=0;
foreach ($files as $file) {
if (substr($file, 0, 1) != '.') {
$filenames[$i]=$file;
$i++;
}
    } 

    $this->getUser()->setAttribute('covfiles',$filenames);
  }
  
  public function executeManagetemplate(sfWebRequest $request)
  {
     
   $dirname = $this->getUser()->getAttribute('project'); 
   $this->logMessage($dirname.'directory name');
    $filename = "uploads/{$dirname}/template"; 
    if (!file_exists($filename)) { 
       mkdir("uploads/{$dirname}/template/", 0777); 
        } 
    $filenames=array();
$source_path = "uploads/{$dirname}/template";
    $dir = realpath($source_path);
$files = scandir($dir);
$i=0;
foreach ($files as $file) {
if (substr($file, 0, 1) != '.') {
$filenames[$i]=$file;
$i++;
}
    } 

    $this->getUser()->setAttribute('temfiles',$filenames);
  }
  
  public function executeUploadcoveragefiles(sfWebRequest $request)
{

}
 public function executeUploadtemplatefiles(sfWebRequest $request)
{

}
public function executeUploadcoverage(sfWebRequest $request)
{
       $dirname = $this->getUser()->getAttribute('project'); 
    $filename = "uploads/{$dirname}/coverage/"; 
    
    if (!file_exists($filename)) { 
       mkdir("uploads/{$dirname}/coverage/", 0777); 

    } 
$target_path = "uploads/{$dirname}/coverage/";
$target_path = $target_path .basename( $_FILES['uploadedfile']['name']);
$this->logMessage("sithik".$target_path);
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    $this->getUser()->setAttribute('uploadmessage', 'The file '.  basename( $_FILES['uploadedfile']['name']).'has been uploaded');
} else{
    $this->getUser()->setAttribute('uploadmessage', 'There was an error uploading the file, please try again! ');
}
$this->redirect('sbtm/managecoverage');
    
}

public function executeUploadtemplate(sfWebRequest $request)
{
       $dirname = $this->getUser()->getAttribute('project'); 
    $filename = "uploads/{$dirname}/template/"; 
    
    if (!file_exists($filename)) { 
       mkdir("uploads/{$dirname}/template/", 0777); 

    } 
$target_path = "uploads/{$dirname}/template/";
$target_path = $target_path .basename( $_FILES['uploadedfile']['name']);
$this->logMessage("sithik".$target_path);
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    $this->getUser()->setAttribute('uploadmessage', 'The file '.  basename( $_FILES['uploadedfile']['name']).'has been uploaded');
} else{
    $this->getUser()->setAttribute('uploadmessage', 'There was an error uploading the file, please try again! ');
}
$this->redirect('sbtm/managetemplate');
    
}
public function executeDeletecoverage(sfWebRequest $request)
{
$dirname = $this->getUser()->getAttribute('project'); 
$filename = "uploads/{$dirname}/coverage/"; 
unlink($filename.$request->getParameter('name'));
$this->redirect('sbtm/managecoverage');
}
public function executeDeletetemplate(sfWebRequest $request)
{
$dirname = $this->getUser()->getAttribute('project'); 
$filename = "uploads/{$dirname}/template/"; 
unlink($filename.$request->getParameter('name'));
$this->redirect('sbtm/managetemplate');
}
public function executeViewcoverage(sfWebRequest $request)
{
$dirname = $this->getUser()->getAttribute('project'); 
$myFile = "uploads/{$dirname}/coverage/".$request->getParameter('name');
$theData = file_get_contents($myFile);
$this->getUser()->setAttribute('theData',$theData);
}
public function executeViewtemplate(sfWebRequest $request)
{
$dirname = $this->getUser()->getAttribute('project'); 
$myFile = "uploads/{$dirname}/template/".$request->getParameter('name');
$theData = file_get_contents($myFile);
$this->getUser()->setAttribute('theData',$theData);
}
public function executeEditcoverage(sfWebRequest $request)
{
$dirname = $this->getUser()->getAttribute('project'); 
$myFile = "uploads/{$dirname}/coverage/".$request->getParameter('name');
$this->getUser()->setAttribute('covfilename', $request->getParameter('name'));
$theData = file_get_contents($myFile);
$this->getUser()->setAttribute('theData',$theData);
}
public function executeEdittemplate(sfWebRequest $request)
{
$dirname = $this->getUser()->getAttribute('project'); 
$myFile = "uploads/{$dirname}/template/".$request->getParameter('name');
$this->getUser()->setAttribute('temfilename', $request->getParameter('name'));
$theData = file_get_contents($myFile);
$this->getUser()->setAttribute('theData',$theData);
}
public function executeCoveragesubmit(sfWebRequest $request)
{
      $dirname = $this->getUser()->getAttribute('project'); 
      $target_path = "uploads/{$dirname}/coverage/";
$target_path = $target_path . $this->getUser()->getAttribute('covfilename');
if(file_put_contents($target_path, $request->getParameter('quote'))) {
       $this->getUser()->setAttribute('uploadmessage', 'The file '.  basename( $_FILES['uploadedfile']['name']).'has been uploaded');
} else{
    $this->getUser()->setAttribute('uploadmessage', 'There was an error uploading the file, please try again! ');
}
   $this->redirect('sbtm/managetemplate'); 
}
public function executeTemplatesubmit(sfWebRequest $request)
{
      $dirname = $this->getUser()->getAttribute('project'); 
      $target_path = "uploads/{$dirname}/template/";
$target_path = $target_path . $this->getUser()->getAttribute('temfilename');
if(file_put_contents($target_path, $request->getParameter('quote'))) {
       $this->getUser()->setAttribute('uploadmessage', 'The file '.  basename( $_FILES['uploadedfile']['name']).'has been uploaded');
} else{
    $this->getUser()->setAttribute('uploadmessage', 'There was an error uploading the file, please try again! ');
}
   $this->redirect('sbtm/managetemplate'); 
}


  public function executeChangesessions(sfWebRequest $request)
  {
     $this->project = $request->getParameter('id');
    
    $this->getUser()->setAttribute('project', $this->project);
    
     $this->project_id = Doctrine_Core::getTable('ProjectCategory')
      ->createQuery('a')
              ->where('a.name = ?',$this->getUser()->getAttribute('project') )
     ->execute();
foreach ($this->project_id as $projectid):
   $dbprojectID =$projectid->getId();
endforeach;
$this->getUser()->setAttribute('projectid', $dbprojectID);
$this->setTemplate('login');
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
    $date = Doctrine_Core::getTable('ProjectCategory')
      ->createQuery('a')
              ->where('a.name = ?',$this->getUser()->getAttribute('project') )
     ->execute();
foreach ($date as $projectid):
   $dbprojectID =$projectid->getId();
   $dbstartdate=$projectid->getStartdate();
$dbenddate=$projectid->getEnddate();
endforeach;
$q = Doctrine_Query::create()
  //->select('((DATEDIFF(PC.enddate,PC.startdate)) - ((WEEK(PC.enddate) - WEEK(PC.startdate))*2) - (CASE WHEN WEEKDAY(PC.startdate) = 6 THEN 1 ELSE 0 END) - (CASE WHEN WEEKDAY(PC.enddate) = 5 THEN 1 ELSE 0 END)) AS workdays')
  ->select('(DATEDIFF(PC.enddate,PC.startdate))  AS workdays')
        ->from('ProjectCategory PC')
  ->where('PC.name = ?',$this->getUser()->getAttribute('project') );
 
$executequery = $q->fetchArray();
 $workday=$executequery[0]['workdays'];
$test=23;
 
 
 $sessions = Doctrine_Core::getTable('Sessions')
      ->createQuery('a')
           ->where('a.project_id = ?',$dbprojectID)
     ->execute();
 $sessions->count();
 

 $start=strtotime($dbstartdate);
$now=strtotime($dbenddate);
$sysdate=strtotime(date("d F Y H:i:s"));
$i=0;
$flag=true;
$data_1 = array();
$data_2 = array();
$data_3 = array();
$this->logMessage($workday.'working days from DB');
while($start<$now)
    {
    
    $this->logMessage($workday.'working days inside loops');
     $start=$start+(60*60*24*1);
    if(date("Y-m-d H:i:s",$start)<=date("Y-m-d H:i:s",$sysdate)){
    $this->logMessage(date("Y-m-d H:i:s",$start).'date'.date("Y-m-d H:i:s",$sysdate));
   
    
    //todo check
    $todosessions = Doctrine_Core::getTable('Sessions')
                 ->createQuery('a')
            ->where('a.project_id = ?',$dbprojectID)
                 ->andWhere('a.status_id = 1')
                 ->andWhere('a.created_at < DATE_ADD( ? , INTERVAL 1 DAY)',date("Y-m-d H:i:s",$start))
                 ->execute();

    $totalsessions = Doctrine_Core::getTable('Sessions')
                 ->createQuery('a')
            ->where('a.project_id = ?',$dbprojectID)
                 ->andWhere('a.created_at < DATE_ADD( ? , INTERVAL 1 DAY)',date("Y-m-d H:i:s",$start))
                 ->execute();
    
    if($todosessions->count()>0){
        if($flag){
        $first_target=round(($todosessions->count()-($todosessions->count()/$workday)),1);
        }
$data_1[$i]= $todosessions->count();
if($flag)
{
    $target_=$first_target;
    $flag=false;
}
else{
$target_=round(($first_target-($first_target/$workday)),1);

}

$data_3[$i] = $target_;
//$workday--;
}
    else{
      $data_1[$i]= 'null'; 
      $data_3[$i] = 'null';
      }
    
    if($totalsessions->count()>0)
$data_2[$i]= $totalsessions->count();
else
    $data_2[$i]= 'null';

    }
    elseif(date("Y-m-d H:i:s",$start)>date("Y-m-d H:i:s",$sysdate)){
      $target_=round(($first_target-($first_target/$workday)),1);

$data_3[$i] = $target_;
//$workday--;  
    }
    else{
       //$workday--; 
    }
    $moth[$i] =date('d-M',$start);
    $i++;
    $workday--; 
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

$g->set_x_labels( $moth );

$g->set_x_label_style( 10, '0x000000', 0, 10 );
$g->set_x_legend(date("Y",$start));
$g->set_tool_tip( '#key#: #val# (#x_label#, #x_legend#)<br>' );
$g->set_y_max( 25 );
$g->y_label_steps( 10 );
$g->y_label_steps(5);
$g->set_y_legend( 'Sessions', 12, '#736AFF' );
echo $g->render();

return sfView::NONE;
  }
public function executePieChartData()
	{
		$chatData = array();
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
     ->execute();              
$todosessions = Doctrine_Core::getTable('Sessions')
                 ->createQuery('a')
        ->where('a.project_id = ?',$dbprojectID)
                 ->andwhere('a.status_id = 1')
                 ->andWhereIn('a.updated_dt < sysdate ')
                 ->execute();
$q = Doctrine_Query::create()
  ->select('u.name as name')
    ->addSelect('COUNT(p.id) as count')
    ->from('STATUS u')
    ->leftJoin('sessions p')
        ->where('u.id = p.status_id')
        ->andwhere('p.project_id = ?',$dbprojectID)
    ->groupBy('u.id');
 
$executequery = $q->fetchArray();
foreach ($executequery as $exe) {
  switch ($exe['name']) {
    case 'Todo':
        $this->logMessage($exe['name'].'todo');
        if($exe['count']>0){
        $data[0]=$exe['count'];
        $sessionname[0]='Todo Sessions';
        }
        else
          $data[0]=0  ;
        break;
    case 'Submitted':
        $this->logMessage($exe['name'].'sub');
        if($exe['count']>0){
        $data[1]=$exe['count'];
        $sessionname[1]='Submitted sessions';
        }
        else
          $data[1]=0  ;
        break;
    case 'Running':
        $this->logMessage($exe['name'].'running');
        if($exe['count']>0){
        $data[2]=$exe['count'];
        $sessionname[2]='Running Sessions';
        }
        else
          $data[2]=0  ;
        break;
    case 'Approved':
        $this->logMessage($exe['name'].'approved');
        if($exe['count']>0){
        $data[3]=$exe['count'];
        $sessionname[3]='Approved Sessions';
        }
        else
          $data[3]=0  ;
        break;
    case 'Finalize':
        $this->logMessage($exe['name'].'final');
        if($exe['count']>0){
        $data[4]=$exe['count'];
        $sessionname[4]='Finalize Sessions';
        }
        else
          $data[4]=0  ;
        break;
}
}



//$this->logMessage($todosessions->count().'Count');
//$data[0]=$todosessions->count();
//$data[1]=$this->sessions->count();
//$data[2]=$this->sessions->count()-$todosessions->count();
//$data[3]=$this->sessions->count();
//$data[4]=$this->sessions->count()-$todosessions->count();
		//Creating a stGraph object		
		$g = new stGraph();

		//set background color
		$g->bg_colour = '#E4F5FC';

		//Set the transparency, line colour to separate each slice etc.
		$g->pie(80,'#78B9EC','{font-size: 12px; color: #78B9EC;');

		//array two arrray one containing data while other contaning labels 
		$g->pie_values($data, $sessionname);
		
		//Set the colour for each slice. Here we are defining three colours 
		//while we need 7 colours. So, the same colours will be 
		//repeated for the all remaining slices in the same order  
		$g->pie_slice_colours( array('#d01f3c','#356aa0','#c79810') );

		//To display value as tool tip
		//$g->set_tool_tip( '#val#%' );

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
            $this->project_id = Doctrine_Core::getTable('ProjectCategory')
      ->createQuery('a')
              ->where('a.name = ?',$this->getUser()->getAttribute('project') )
     ->execute();
foreach ($this->project_id as $projectid):
   $dbprojectID =$projectid->getId();
endforeach;
$this->getUser()->setAttribute('projectid', $dbprojectID);
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


public function executeDatafiles(sfWebRequest $request)
{
$dirname = $this->getUser()->getAttribute('project'); 
    $filename = "uploads/{$dirname}/datafiles"; 
    if (!file_exists($filename)) { 
       mkdir("uploads/{$dirname}/datafiles/", 0777); 
        } 
    $filenames=array();
$source_path = "uploads/{$dirname}/datafiles";
    $dir = realpath($source_path);
$files = scandir($dir);
$i=0;
foreach ($files as $file) {
if (substr($file, 0, 1) != '.') {
$filenames[$i]=$file;
$i++;
}
    } 

    $this->getUser()->setAttribute('files',$filenames); 
     
}
public function executeUploaddatafiles(sfWebRequest $request)
{

}
public function executeUploaddata(sfWebRequest $request)
{
       $dirname = $this->getUser()->getAttribute('project'); 
    $filename = "uploads/{$dirname}/datafiles/"; 
    
    if (!file_exists($filename)) { 
       mkdir("uploads/{$dirname}/datafiles/", 0777); 

    } 
$target_path = "uploads/{$dirname}/datafiles/";
$target_path = $target_path .basename( $_FILES['uploadedfile']['name']);
$this->logMessage("sithik".$target_path);
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
    $this->getUser()->setAttribute('uploadmessage', 'The file '.  basename( $_FILES['uploadedfile']['name']).'has been uploaded');
} else{
    $this->getUser()->setAttribute('uploadmessage', 'There was an error uploading the file, please try again! ');
}
$this->redirect('sbtm/datafiles');
    
}
public function executeDownloaddatafiles(sfWebRequest $request) {
      
            $myFile = $request->getParameter('name');
           //$path = "uploads/Drop 1/datafiles/".$myFile; // change the path to fit your websites document structure
           $path = $_SERVER['DOCUMENT_ROOT']."/uploads/Drop 1/datafiles/"; // change the path to fit your websites document structure
$fullPath = $path.$myFile;
 
if ($fd = fopen ($fullPath, "r")) {
    $fsize = filesize($fullPath);
    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);
    switch ($ext) {
        case "pdf":
        header("Content-type: application/pdf"); // add here more headers for diff. extensions
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
        break;
        default;
        header("Content-type: application/octet-stream");
        header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
    }
    header("Content-length: $fsize");
    header("Cache-control: private"); //use this to open files directly
    while(!feof($fd)) {
        $buffer = fread($fd, 2048);
        echo $buffer;
    }
}
fclose ($fd);
exit;

	    return sfView::NONE;
            
            
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
$admin_mail=array();
$user_mail=array();
$adi=0;
$usi=0;
$flag=0;
if($request->getparameter('status_action')=='Submitted'){
    $flag=1;
     $this->admin = Doctrine_Core::getTable('Logins')
      ->createQuery('a')
             ->where('a.role_id = ?',1)
     ->execute();
     
     foreach ($this->admin as $adm):
   $admin_mail[$adi] =$adm->getEmail();
     $adi++;
endforeach;
     $sub="Session Submitted for Review";
                              $subject= '<h1 class="h1">Session Submitted for Review</h1>
                                                                <strong>Dear Admin/Reviewer:</strong> <br />Session '.$this->getUser()->getAttribute('filename').' submitted for Reviewing kindly take a look at the session by logging in to SBTM web application!
                                                                <br />
                                                                <br />
                                                                To Login to the SBTM web application  <a href="http://10.165.255.22/frontend_dev.php/sbtm" target="_blank">click here</a>
                                                                ';} 
                                                                else if($request->getparameter('status_action')=='Finalize') {
                                                                    $this->sessu = Doctrine_Core::getTable('Sessions')
                                                                     ->createQuery('a')
                                                                     ->where('a.sessionname = ?', $this->getUser()->getAttribute('filename'))
                                                                     ->execute();
                                                                     foreach ($this->sessu as $seusr):
   $sesuser =$seusr->getTester();
endforeach;
                                                                     $this->users = Doctrine_Core::getTable('Logins')
                                                                     ->createQuery('a')
                                                                     ->whereIn('a.name ', array($this->getUser()->getAttribute('username'),$sesuser))
                                                                     ->execute();
                                                                     foreach ($this->users as $usr):
   $user_mail[$usi] =$usr->getEmail();
     $usi++;
endforeach;

     $sub="Session in Finalize State";                                                       
$subject=        '
                                                                     <h1 class="h1">Session in Finalize State</h1>
                                                                <strong>Dear User:</strong> <br />Session '.$this->getUser()->getAttribute('filename').' in Finalize Status kindly take a look at the session by logging in to SBTM web application!
                                                                <br />
                                                                <br />
                                                                To Login to the SBTM web application  <a href="http://10.165.255.22/frontend_dev.php/sbtm" target="_blank">click here</a>
                                                                
';}
$transport = Swift_SmtpTransport::newInstance('10.165.133.27', 25)
  ;
$mailer = Swift_Mailer::newInstance($transport);
$message = Swift_Message::newInstance($sub)
  ->setFrom(array('Ian.Phillips@comverse.com' => 'SBTM ADMIN'));
   if($flag==1){
  $message->setTo($admin_mail);}
   else{
       $message->setTo($user_mail);
    
       }
  $message->setBody('<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 

<style type="text/css">
/* Client-specific Styles */
#outlook a{padding:0;} /* Force Outlook to provide a "view in browser" button. */
body{width:100% !important;} .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
body{-webkit-text-size-adjust:none;} /* Prevent Webkit platforms from changing default text sizes. */

body{margin:0; padding:0;}
img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
table td{border-collapse:collapse;}
#backgroundTable{height:100% !important; margin:0; padding:0; width:100% !important;}


body, #backgroundTable{
/*@editable*/ background-color:#FAFAFA;
}

/**
* @tab Page
* @section email border
* @tip Set the border for your email.
*/
#templateContainer{
/*@editable*/ border: 1px solid #DDDDDD;
}

/**
* @tab Page
* @section heading 1
* @tip Set the styling for all first-level headings in your emails. These should be the largest of your headings.
* @style heading 1
*/
h1, .h1{
/*@editable*/ color:#202020;
display:block;
/*@editable*/ font-family:Arial;
/*@editable*/ font-size:34px;
/*@editable*/ font-weight:bold;
/*@editable*/ line-height:100%;
margin-top:0;
margin-right:0;
margin-bottom:10px;
margin-left:0;
/*@editable*/ text-align:left;
}

/**
* @tab Page
* @section heading 2
* @tip Set the styling for all second-level headings in your emails.
* @style heading 2
*/
h2, .h2{
/*@editable*/ color:#202020;
display:block;
/*@editable*/ font-family:Arial;
/*@editable*/ font-size:30px;
/*@editable*/ font-weight:bold;
/*@editable*/ line-height:100%;
margin-top:0;
margin-right:0;
margin-bottom:10px;
margin-left:0;
/*@editable*/ text-align:left;
}

/**
* @tab Page
* @section heading 3
* @tip Set the styling for all third-level headings in your emails.
* @style heading 3
*/
h3, .h3{
/*@editable*/ color:#202020;
display:block;
/*@editable*/ font-family:Arial;
/*@editable*/ font-size:26px;
/*@editable*/ font-weight:bold;
/*@editable*/ line-height:100%;
margin-top:0;
margin-right:0;
margin-bottom:10px;
margin-left:0;
/*@editable*/ text-align:left;
}


h4, .h4{
/*@editable*/ color:#202020;
display:block;
/*@editable*/ font-family:Arial;
/*@editable*/ font-size:22px;
/*@editable*/ font-weight:bold;
/*@editable*/ line-height:100%;
margin-top:0;
margin-right:0;
margin-bottom:10px;
margin-left:0;
/*@editable*/ text-align:left;
}


#templateHeader{
/*@editable*/ background-color:#FFFFFF;
/*@editable*/ border-bottom:0;
}

.headerContent{
/*@editable*/ color:#202020;
/*@editable*/ font-family:Arial;
/*@editable*/ font-size:34px;
/*@editable*/ font-weight:bold;
/*@editable*/ line-height:100%;
/*@editable*/ padding:0;
/*@editable*/ text-align:center;
/*@editable*/ vertical-align:middle;
}

.headerContent a:link, .headerContent a:visited, /* Yahoo! Mail Override */ .headerContent a .yshortcuts /* Yahoo! Mail Override */{
/*@editable*/ color:#336699;
/*@editable*/ font-weight:normal;
/*@editable*/ text-decoration:underline;
}

#headerImage{
height:auto;
max-width:600px !important;
}


#templateContainer, .bodyContent{
/*@editable*/ background-color:#FFFFFF;
}


.bodyContent div{
/*@editable*/ color:#505050;
/*@editable*/ font-family:Arial;
/*@editable*/ font-size:14px;
/*@editable*/ line-height:150%;
/*@editable*/ text-align:left;
}


.bodyContent div a:link, .bodyContent div a:visited, /* Yahoo! Mail Override */ .bodyContent div a .yshortcuts /* Yahoo! Mail Override */{
/*@editable*/ color:#336699;
/*@editable*/ font-weight:normal;
/*@editable*/ text-decoration:underline;
}

.bodyContent img{
display:inline;
height:auto;
}


</style>
</head>
<center>
         
                        <!-- // End Template Preheader \\ -->
                     <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateContainer">
                         
                         <tr>
                             <td align="center" valign="top">
                                    <!-- // Begin Template Body \\ -->
                                 <table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
                                     <tr>
                                            <td valign="top" class="bodyContent">
                                
                                                <!-- // Begin Module: Standard Content \\ -->
                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td valign="top">
                                                            <div mc:edit="std_content00">
                                                            '.$subject.'
                                                            
</div>
</td>
                                                    </tr>
                                                </table>
                                                <!-- // End Module: Standard Content \\ -->
                                                
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Body \\ -->
                                </td>
                            </tr>
                         <tr>
                             
                            </tr>
                        </table>
                        <br />
                    </td>
                </tr>
            </table>
        </center>','text/html')
  ;
$result = $mailer->send($message);
$this->logMessage($usre_mail.'sithik');
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
    
    $this->project_category = Doctrine_Core::getTable('ProjectCategory')
      ->createQuery('a')
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
