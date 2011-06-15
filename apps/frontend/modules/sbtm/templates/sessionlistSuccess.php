<div id="sf_admin_container">
    <form method="post" action="">
    <div class="sf_admin_list" style="overflow:auto; width:770px; height: 200px;">
      <table  border="5">
      <thead>
        <tr>
          <th class="sf_admin_text sf_admin_list_th_name">
           Approved Sessions
          </th>       
          <th class="sf_admin_text sf_admin_list_th_name">
           Tested by
          </th>          
          <th class="sf_admin_text sf_admin_list_th_name">
           Completed Date
          </th>          
         </tr>
      </thead>
      
      <tbody>
          <?php foreach ($approved_sessions as $app): ?>
            <tr class="sf_admin_row odd">
            <td class="sf_admin_text sf_admin_list_td_id">
            <a href="<?php echo url_for('sessions/show?id='.$app->getId()) ?>"><?php echo $app->getSessionname() ?></a></td>
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

