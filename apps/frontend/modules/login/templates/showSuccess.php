<div id="sf_admin_container">
    <titles>User Details</titles>
<div class="sf_admin_list">
<table>
  <tbody>
    <tr class="sf_admin_row odd">
      <th class="sf_admin_text sf_admin_list_th_name">Id:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $logins->getId() ?></td>
    </tr>
    <tr>
      <th class="sf_admin_text sf_admin_list_th_name">Name:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $logins->getName() ?></td>
    </tr>
    <tr>
      <th class="sf_admin_text sf_admin_list_th_name">Username:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $logins->getUsername() ?></td>
    </tr>
    
    <tr>
      <th class="sf_admin_text sf_admin_list_th_name">Email:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $logins->getEmail() ?></td>
    </tr>
    <tr>
      <th class="sf_admin_text sf_admin_list_th_name">Role:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $logins->getRoleId() ?></td>
    </tr>
    <tr>
      <th class="sf_admin_text sf_admin_list_th_name">Islocked:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php if($logins->getIslocked()==''){echo 'No';} else{echo 'Yes';}?></td>
    </tr>
  </tbody>
</table>
</div>

    
    <ul class="sf_admin_actions">
      <li class="sf_admin_action_previous"><a href="<?php echo url_for('sbtm/useradmin') ?>">Back</a></li>    </ul>
    

<!--a href="<?php echo url_for('login/edit?id='.$logins->getId()) ?>">Edit</a-->
&nbsp;
<!--a href="<?php echo url_for('sbtm/useradmin') ?>">Back</a-->
 </div>