<div id="sf_admin_container">
<div class="sf_admin_list">
<table>
  <tbody>
    <tr class="sf_admin_row odd">
      <th class="sf_admin_text sf_admin_list_th_name">Id:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $sessions->getId() ?></td>
    </tr>
    <tr>
      <th class="sf_admin_text sf_admin_list_th_name">Sessionname:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $sessions->getSessionname() ?></td>
    </tr>
    <tr>
      <th class="sf_admin_text sf_admin_list_th_name">Charter:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $sessions->getCharter() ?></td>
    </tr>
    <tr>
      <th class="sf_admin_text sf_admin_list_th_name">Areas:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $sessions->getAreas() ?></td>
    </tr>
    <tr>
      <th class="sf_admin_text sf_admin_list_th_name">Testnotes:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $sessions->getTestnotes() ?></td>
    </tr>
    <tr>
      <th class="sf_admin_text sf_admin_list_th_name">Ready:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $sessions->getReady() ?></td>
    </tr>
    <tr>
      <th class="sf_admin_text sf_admin_list_th_name">Tester:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $sessions->getTester() ?></td>
    </tr>
    <tr>
    <th class="sf_admin_text sf_admin_list_th_name">Status:</th>
      <td class="sf_admin_text sf_admin_list_td_name"><?php echo $sessions->getStatusId() ?></td>
    </tr>

  </tbody>
</table>

</div>
<ul class="sf_admin_actions">
      <li class="sf_admin_action_previous"><a href="<?php echo url_for('sbtm/sessions') ?>">Back</a></li>    </ul>
    


<!--a href="<?php echo url_for('sessions/edit?id='.$sessions->getId()) ?>">Edit</a-->
&nbsp;
<!--a href="<?php echo url_for('sbtm/sessions') ?>">Back</a-->
</div>