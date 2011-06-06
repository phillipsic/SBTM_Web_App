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

    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_javascripts() ?>
    <?php include_stylesheets() ?>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <div class="content">
          <h1><a href="<?php echo url_for('sbtm/index') ?>">
            <img src="/images/comverse-mini.png" alt="PQA SBTM - Web based" />
          </a></h1>
          <!--div id="sub_header">
            <div class="post">
              <h2>Ask for people</h2>
              <div>
                <a href="<?php echo url_for('sbtm/index') ?>">Post a Job</a>
              </div>
            </div>
 
            <div class="search">
              <h2>Ask for a job</h2>
              <form action="" method="get">
                <input type="text" name="keywords"
                  id="search_keywords" />
                <input type="submit" value="search" />
                <div class="help">
                  Enter some keywords (city, country, position, ...)
                </div>
              </form>
            </div>
          </div-->
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
            
            
          <?php if ($sf_user->hasAttribute('logindone')): ?>  
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

<div id="menu">
    <?php $admin=$sf_user->getAttribute('adminrole');
    if ($admin=="Admin"): ?> 
      <td><a href="<?php echo url_for('sbtm/useradmin') ?>"><?php echo "User Admin" ?></a></td>
      <td> | </td>
      <td><a href="<?php echo url_for('sbtm/projectadmin') ?>"><?php echo "Project Admin" ?></a></td>
      <td> | </td>
      <?php endif ?> 
      <td><a href="<?php echo url_for('sbtm/reporting') ?>"><?php echo "Reporting" ?></a></td>
      <td> | </td>
      <td><a href="<?php echo url_for('sbtm/sessions') ?>"><?php echo "Sessions" ?></a></td>
        <td> | </td>
      <td><a href="<?php echo url_for('sbtm/logout') ?>"><?php echo "Logout" ?></a></td>
      <div id="job">  
      <h2>Logged In : <?php echo $sf_user->getAttribute('username') ?></h2>
      </div>  
</div>
       <?php endif ?>     
            
          <?php echo $sf_content ?>
        </div>
      </div>
 
      <div id="footer">
        <div class="content">
         
        </div>
      </div>
    </div>
  </body>
</html>