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


<div id="sf_admin_container">
    <form method="post" action="">
    <div class="sf_admin_list">
      <table  border="5">
           <?php if ($users->count()>0){ ?>
      <thead>
        <tr>
          <th class="sf_admin_text sf_admin_list_th_name">
           Name
          </th>       
          <th class="sf_admin_text sf_admin_list_th_name">
           Email
          </th>          
          <th class="sf_admin_text sf_admin_list_th_name">
           Role
          </th>          
          <th class="sf_admin_text sf_admin_list_th_name">
           Locked
          </th>
          <th id="sf_admin_list_th_actions">Actions</th>
        </tr>
      </thead>
       <?php } else{ ?>  
      <div class="record_error">
            <?php //$sf_user->getAttributeHolder()->clear();
            echo 'No record Found'; ?>
          </div>
      <?php }  ?> 
      <tbody>
          <?php foreach ($users as $user): ?>
            <tr class="sf_admin_row odd">
            <td class="sf_admin_text sf_admin_list_td_id">
            <a href="<?php echo url_for('login/show?id='.$user->getId()) ?>"><?php echo $user->getName() ?></a></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $user->getEmail() ?></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $user->getRole() ?></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php if($user->getIslocked()==''){echo 'No';} else{echo 'Yes';} ?></td>
            <td><ul class="sf_admin_td_actions">
            <li class="sf_admin_action_edit">
            <a href="<?php echo url_for('login/edit?id='.$user->getId()) ?>">Edit</a>
            </li>  
            <li class="sf_admin_action_delete">
            <?php echo link_to('Delete', 'login/delete?id='.$user->get('id'), array('post' => true, 'confirm' => 'Are you sure?')) ?>
            </li> 
            </ul>

            </td>
          </tr>
          <?php endforeach; ?> 
        </tbody>
    </table>
  </div>

    <ul class="sf_admin_actions">
      <!--li class="sf_admin_batch_actions_choice">
  <select name="batch_action">
    <option value="">Choose an action</option>
    <option value="batchDelete">Delete</option>
  </select>
      <input type="hidden" value="7ff886bdfe2685bcac278e510c309b06" name="_csrf_token">
    <input type="submit" value="go">
</li-->
      <li class="sf_admin_action_new"><a href="<?php echo url_for('login/new') ?>">create New User</a></li>    </ul>
    </form>
  </div>

