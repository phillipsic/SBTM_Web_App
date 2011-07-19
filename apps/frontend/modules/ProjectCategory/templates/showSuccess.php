<div id="sf_admin_container">
     <form method="post" action="<?php echo url_for('sessions/copysessions') ?>">
     <titles>Project Details</titles>
<div class="sf_admin_list">
    
<table>
  <tbody>
    <tr class="sf_admin_row odd">
      <th class="sf_admin_text sf_admin_list_th_name">Id:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $project_category->getId() ?></td>
    </tr>
    <tr>
      <th class="sf_admin_text sf_admin_list_th_name">Name:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $project_category->getName() ?></td>
    </tr>
    <tr>
      <th class="sf_admin_text sf_admin_list_th_name">Start Date:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $project_category->getStartdate() ?></td>
    </tr>
    <tr>
      <th class="sf_admin_text sf_admin_list_th_name">End Date:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $project_category->getEnddate() ?></td>
    </tr>
    <tr>
      <th class="sf_admin_text sf_admin_list_th_name">Completed Status:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php if($project_category->getCompletetag()==''){echo 'No';} else{echo 'Yes';}  ?></td>
    </tr>
  </tbody>
</table>
        
        
</div>
   <ul class="sf_admin_actions">
        <li class="sf_admin_action_next"><a href="<?php echo url_for('sbtm/managecoverage?id='.$project_category->getId()) ?>">Manage coverage.ini</a></li>
        <li class="sf_admin_action_next"><a href="<?php echo url_for('sbtm/managetemplate?id='.$project_category->getId()) ?>">Manage Template</a></li>
        </ul>
<ul class="sf_admin_actions">
      <!--li class="sf_admin_action_previous"><a href="<?php echo url_for('sbtm/projectadmin') ?>">Back</a></li-->    
<li class="sf_admin_action_next"><a href="<?php echo url_for('sbtm/managesession?id='.$project_category->getId()) ?>">Manage session</a></li>

            <li class="sf_admin_action_edit">
            <a href="<?php echo url_for('Projectcategory/edit?id='.$project_category->getId()) ?>">Edit</a>
            </li> 
            <li><?php if ($progress_sessions->count()>0 &&  ($sf_user->getAttribute('adminrole')=="Admin")){ ?>
     <th>
           Copy Unfinished sessions to 
          </th>
       <th class="sf_admin_batch_actions_choice">
           <select name="project_action">
    <?php foreach ($project_category1 as $project): 
    $value=$project->getName();?> 
    <option value="<?php echo $value?>"><?php echo $project->getName()?></option>
    <?php endforeach; ?> 
    </select>
    </th>
    
    <th>        <input type="submit" value=" Go " /></th> 
        

        <?php } ?></li>
            </ul>   

<!--a href="<?php echo url_for('ProjectCategory/edit?id='.$project_category->getId()) ?>">Edit</a-->
&nbsp;
<!--a href="<?php echo url_for('sbtm/projectadmin') ?>">Back</a-->
  </form>
</div>