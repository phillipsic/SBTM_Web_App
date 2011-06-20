<!-- apps/frontend/templates/layout.php -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
   <title>
  <?php if (!include_slot('title')): ?>
    PQA SBTM - Web based
  <?php endif ?>
</title>
      
<link rel="stylesheet" type="text/css" href="/css/script.css" />
<script type="text/javascript" src="/js/popup-window.js"></script>

    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_javascripts() ?>
    <?php include_stylesheets() ?>
  </head>
  <body>
<div class="sample_popup"     id="popup" style="display: none;">
<div class="menu_form_header" id="popup_drag">
<img class="menu_form_exit"   id="popup_exit" src="/images/exit.png" alt="" />
&nbsp;&nbsp;&nbsp;About
</div>

<div class="menu_form_body">
<form action="">
<table>
    <?php
    $fh = fopen("config/version.txt", 'r');
$theData=null;
while(! feof($fh))
  { ?>
 <tr><th><?php  echo fgets($fh)."\r\n"; ?></th></tr>
<?php 
 //$theData += fgets($fh)."\n";
  //logMessage($theData, 'err'); 
  }

//$ini_array = file_get_contents("config/version.ini");

?>

</table>
</form>

</div>

</div>
    <div id="container">
      <div id="header">
        <div class="content">
           
          <h1><a href="<?php echo url_for('sbtm/index') ?>" />
</h1>
            <h2> <a href="#" onclick="javascript:popup_show('popup', 'popup_drag', 'popup_exit', 'screen-center',         0,   0)">About Me</a>
           </h2>
                </div>
      </div>
 
      <div id="content">
        <?php if ($sf_user->hasFlash('notice')): ?>
          <div class="flash_notice">
            <?php echo $sf_user->getFlash('notice') ?>
          </div>
        <?php endif ?>
 
        <?php if ($sf_user->hasFlash('error')): ?>
          <div class="flash_error">
            <?php //$sf_user->getAttributeHolder()->clear();
            echo $sf_user->getFlash('error'); ?>
          </div>
        <?php endif ?>
 
        <div class="content">
            
            
          <?php if ($sf_user->hasAttribute('logindone') && $sf_user->getAttribute('new')!='yes'): ?>  
            <div id="sf_admin_container">
 <table>  
<thead>
<tr>
<th class="sf_admin_text sf_admin_list_th_name">
  Project  : 
</th>
<th> 
    <?php echo $sf_user->getAttribute('project') ?>
</th>
</tr>

 </thead>
</table>
</div>
 

            
<div id="job">  
      <h2>Logged In : <?php echo $sf_user->getAttribute('username') ?></h2>
      </div> 
<div id="menu">
    <?php $admin=$sf_user->getAttribute('adminrole');
    if ($admin=="Admin"): ?> 
    <td><a href="<?php echo url_for('sbtm/adminmysession') ?>"><?php echo "Review Session" ?></a></td>
        <td> | </td>
      <td><a href="<?php echo url_for('sbtm/useradmin') ?>"><?php echo "User Admin" ?></a></td>
      <td> | </td>
      <td><a href="<?php echo url_for('sbtm/projectadmin') ?>"><?php echo "Project Admin" ?></a></td>
      <td> | </td>
      <?php endif ?>
       <td><a href="<?php echo url_for('sbtm/usermysession') ?>"><?php echo "My Session" ?></a></td>
        <td> | </td>
       <td><a href="<?php echo url_for('sbtm/reporting') ?>"><?php echo "Reporting" ?></a></td>
      <td> | </td>
      <td><a href="<?php echo url_for('sbtm/sessions') ?>"><?php echo "Sessions" ?></a></td>
        <td> | </td>
      <td><a href="<?php echo url_for('sbtm/logout') ?>"><?php echo "Logout" ?></a></td>
       
</div>
       <?php endif ?>     
            
          <?php echo $sf_content ?>
        </div>
      </div>
 
      <div id="footer">
        
      </div>
    </div>
  </body>
</html>