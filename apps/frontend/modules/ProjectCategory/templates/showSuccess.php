<div id="sf_admin_container">
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
      <li class="sf_admin_action_previous"><a href="<?php echo url_for('sbtm/projectadmin') ?>">Back</a></li>    </ul>
    

<!--a href="<?php echo url_for('ProjectCategory/edit?id='.$project_category->getId()) ?>">Edit</a-->
&nbsp;
<!--a href="<?php echo url_for('sbtm/projectadmin') ?>">Back</a-->
</div>