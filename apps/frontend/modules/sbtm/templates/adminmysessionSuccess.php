<script type="text/javascript">
/* &lt;![CDATA[ */
function checkAll()
{
 
  var boxes = document.getElementsByTagName('input');
  for(var index = 0; index < boxes.length; index++){
      box = boxes[index];
      if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') {
          box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked}
  } 
      return true;
}
/* ]]&gt; */
</script>
<?php echo $sf_user->getAttribute('sithik') ?>
<?php $admin=$sf_user->getAttribute('adminrole');
$admin=$sf_user->getAttribute('adminrole');?> 
<div id="sf_admin_container">
    <form method="post" action="">
    <div class="sf_admin_list">
      <table  border="5">
           <?php if ($sessions->count()>0){ ?>
      <thead>
        <tr>
          
          <th class="sf_admin_text sf_admin_list_th_name">
           Session Name
          </th>
           <th class="sf_admin_text sf_admin_list_th_name">
            Status
           </th>
           <th id="sf_admin_list_th_actions">Actions</th>
           <th class="sf_admin_date sf_admin_list_th_created_at">
            Updated at
           </th>
        </tr>
      </thead>
       <?php } else{ ?>  
      <div class="record_error">
            <?php //$sf_user->getAttributeHolder()->clear();
            echo 'No record Found'; ?>
          </div>
      <?php }  ?> 
      <tbody>
          <?php foreach ($sessions as $session): ?>
            <tr class="sf_admin_row odd">
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $session->getSessionname() ?></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $session->getStatus() ?></td>
            

            <td>
            <ul class="sf_admin_td_actions">
 <?php if ($admin=="Admin"): ?> 
            <li class="sf_admin_action_tick">
            <a href="<?php echo url_for('sessions/review?name='.$session->getSessionname().'&id='.$session->getId()) ?>">Review</a>
            </li>  
            <li class="sf_admin_action_delete">
            <?php echo link_to('Delete', 'sessions/delete?id='.$session->get('id'), array('post' => true, 'confirm' => 'Are you sure?')) ?>
            </li> 
              <?php endif ?>

            </ul>
            </td>
            <td class="sf_admin_date sf_admin_list_td_created_at">
             <?php echo $session->getUpdatedAt() ?></td>
          </tr>
          <?php endforeach; ?> 
        </tbody>
    </table>
  </div>

    </form>
  </div>

