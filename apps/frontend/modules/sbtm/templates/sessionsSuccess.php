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
<?php $admin=$sf_user->getAttribute('adminrole');
$admin=$sf_user->getAttribute('adminrole');?> 
<div id="sf_admin_container">
    <form method="post" action="">
    <div class="sf_admin_list">
      <table  border="5">
      <thead>
        <tr>
          
          <th class="sf_admin_text sf_admin_list_th_name">
           Session Name
          </th>
          <th class="sf_admin_text sf_admin_list_th_name">
           Ready For Run
          </th>
          <th class="sf_admin_text sf_admin_list_th_name">
            Status
           </th>
           <th class="sf_admin_date sf_admin_list_th_created_at">
            Created at
           </th>
           <th id="sf_admin_list_th_actions">Tester/Actions</th>
        </tr>
      </thead>
      
      <tbody>
          <?php foreach ($sessions as $session): ?>
            <tr class="sf_admin_row odd">
            <td class="sf_admin_text sf_admin_list_td_name">
            <a href="<?php echo url_for('sessions/show?id='.$session->getId()) ?>"><?php echo $session->getSessionname() ?></a></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $session->getReady() ?></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $session->getStatus() ?></td>
            <td class="sf_admin_date sf_admin_list_td_created_at">
             <?php echo $session->getCreatedAt() ?></td>

            <td>
            <ul class="sf_admin_td_actions">
                <?php if ($admin=="Admin"): ?> 
            <li class="sf_admin_action_edit">
            <a href="<?php echo url_for('sessions/edit?id='.$session->getId()) ?>">Edit</a>
            </li>  
            <li class="sf_admin_action_delete">
            <?php echo link_to('Delete', 'sessions/delete?id='.$session->get('id'), array('post' => true, 'confirm' => 'Are you sure?')) ?>
            </li> 
              <?php endif ?>
            <?php if ($session->getTester()== null){ ?>
            <li class="sf_admin_action_download">
            <a href="<?php echo url_for('sessions/download?id='.$session->getId()) ?>">Download</a>
            </li> 
            <?php }
            else{?>
               <li class="sf_admin_action_download">
            <?php echo $session->getTester() ?></li> 
             <?php } ?>

            <li class="sf_admin_action_upload">
            <a href="<?php echo url_for('sbtm/upload?id='.$session->getId()) ?>">Upload</a>
            </li> 
            </ul>
            </td>
          </tr>
          <?php endforeach; ?> 
        </tbody>
    </table>
  </div>
<?php if ($admin=="Admin"): ?> 
    <ul class="sf_admin_actions">
      <li class="sf_admin_action_new"><a href="<?php echo url_for('sessions/new') ?>">Add Session</a></li>    </ul>
        <?php endif ?>
    </form>
  </div>

