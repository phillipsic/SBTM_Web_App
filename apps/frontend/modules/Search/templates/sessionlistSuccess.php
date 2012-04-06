<div id="sf_admin_container">
    <form method="post" action="<?php echo url_for('sessions/copysessions') ?>">
        <titles>Sessions List </titles>
    <div class="sf_admin_list" style="overflow:auto; width:770px; height: 300px;">
      <table  border="5">
          
      <thead>
        <tr>
          <th class="sf_admin_text sf_admin_list_th_name">
           Session Name
          </th>       
          <th class="sf_admin_text sf_admin_list_th_name">
           Project
          </th>          
          <th class="sf_admin_text sf_admin_list_th_name">
           Completed Date
          </th>          
         </tr>
      </thead>
     
      <div class="record_error">
           echo 'No record Found'; ?>
       </div>
      
      <tbody>
          <?php foreach ($sessions as $ses): ?>
            <tr class="sf_admin_row odd">
            <td class="sf_admin_text sf_admin_list_td_id">
            <a href="<?php echo url_for('sessions/sessionreadonly?name='.$ses->getSessionname().'&id='.$app->getId()) ?>"><?php echo $app->getSessionname() ?></a></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $app->getTester() ?></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $app->getUpdatedAt() ?></td>
                        </td>
          </tr>
          <?php endforeach; ?> 
        </tbody>
    </table>
  </div>
       
        <div class="sf_admin_list" style="overflow:auto; width:770px; height: 200px;">
      <table  border="5">
          <?php if ($progress_sessions->count()>0){ ?>
          
      <thead>
        <tr>
          <th class="sf_admin_text sf_admin_list_th_name">
           Unfinished Sessions
          </th>       
          <th class="sf_admin_text sf_admin_list_th_name">
           Status
          </th>
          <th class="sf_admin_text sf_admin_list_th_name">
           Owner
          </th>  
          <th class="sf_admin_text sf_admin_list_th_name">
           Last updated 
          </th>          
         </tr>
      </thead>
      <?php } else{ ?>  
      <div class="record_error">
            <?php //$sf_user->getAttributeHolder()->clear();
            echo 'Unfinised Sessions ';
            echo 'No record Found'; ?>
          </div>
      <?php }  ?> 
      <tbody>
          <?php foreach ($progress_sessions as $prog): ?>
            <tr class="sf_admin_row odd">
            <td class="sf_admin_text sf_admin_list_td_id">
            <?php echo $prog->getSessionname() ?></td>
            <td class="sf_admin_text sf_admin_list_td_id">
            <?php echo $prog->getStatus() ?></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $prog->getTester() ?></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $prog->getUpdatedAt() ?></td>
                        </td>
          </tr>
          <?php endforeach; ?> 
          
        </tbody>
    </table>
  </div>

    </form>
  </div>

