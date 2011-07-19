<div id="sf_admin_container">
    <form method="post" action="">
        <titles>Manage Coverage</titles>
<div class="sf_admin_list" style="overflow:auto; width:770px; height: 200px;">
      <table  border="5">
          <?php $files=array();
          $files=$sf_user->getAttribute('covfiles');
          if (count($files)>0){ ?>
          
      <thead>
        <tr>
          <th class="sf_admin_text sf_admin_list_th_name">
           Coverage File
          </th>       
          <th id="sf_admin_list_th_actions">Actions</th>         
         </tr>
      </thead>
      <?php } else{ ?>  
      <div class="record_error">
            <?php //$sf_user->getAttributeHolder()->clear();
            echo 'Coverage Files ';
            echo 'No record Found'; ?>
          </div>
      <?php }  ?> 
      <tbody>
          <?php foreach ($files as $file): ?>
            <tr class="sf_admin_row odd">
            <td class="sf_admin_text sf_admin_list_td_id">
            <?php echo $file ?></td>
            <td><ul class="sf_admin_td_actions"><li class="sf_admin_action_tick">
            <a href="<?php echo url_for('sbtm/viewcoverage?name='.$file) ?>">view</a>
            </li> 
            <li class="sf_admin_action_edit">
            <a href="<?php echo url_for('sbtm/editcoverage?name='.$file) ?>">Edit</a>
            </li>
            <li class="sf_admin_action_delete">
            <?php echo link_to('Delete', 'sbtm/deletecoverage?name='.$file, array('post' => true, 'confirm' => 'Are you sure?')) ?>
            </li></ul>
      </td>
                        </td>
          </tr>
          <?php endforeach; ?> 
          
        </tbody>
    </table>
  </div>
<ul class="sf_admin_actions">
      <li class="sf_admin_action_new"><a href="<?php echo url_for('sbtm/uploadcoveragefiles') ?>">Upload Coverage File</a></li>    </ul>
    </form>
  </div>

