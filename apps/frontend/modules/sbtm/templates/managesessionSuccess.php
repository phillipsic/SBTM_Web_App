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
    <form method="post" action="<?php echo url_for('sessions/statusready') ?>">
    <div class="sf_admin_list" style="overflow:auto; width:900px; height: 33w0px;">
      <table  border="5">
      <thead>
        <tr>
           <th id="sf_admin_list_batch_actions">
              <input type="checkbox" onclick="checkAll();" id="sf_admin_list_batch_checkbox">
          </th>
          <th class="sf_admin_text sf_admin_list_th_name">
           Session Name
          </th>
          <th class="sf_admin_text sf_admin_list_th_name">
           Ready For Run
          </th>
          <th class="sf_admin_text sf_admin_list_th_name">
            Status
           </th>
           <th id="sf_admin_list_th_actions">Tester/Actions</th>
           
           
        </tr>
      </thead>
      
      <tbody>
          <?php foreach ($sessions as $session): ?>
            <tr class="sf_admin_row odd">
             <td>
            <input type="checkbox" class="sf_admin_batch_checkbox" value=<?php echo $session->getId() ?> name="ids[]">
            </td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $session->getSessionname() ?></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $session->getReady() ?></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $session->getStatus() ?></td>
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
             
            </ul>
            </td>
          </tr>
          <?php endforeach; ?> 
        </tbody>
        
    </table>
        
  </div><div>
     <th>
           Select ready Status of sessions
          </th>
       <th class="sf_admin_batch_actions_choice">
    <select name="ready_action">
    <option value="">Choose an action</option>
    <option value="Yes">Yes</option>
    <option value="No">No</option>
    </select>
    </th>
    
    <th>        <input type="submit" value=" Go " /></th> 
        
        </div><ul class="sf_admin_actions">
<?php if ($admin=="Admin"): ?> 
   
      <li class="sf_admin_action_new"><a href="<?php echo url_for('sessions/new') ?>">Add Session</a></li> 

      <li class="sf_admin_action_upload"><a href="<?php echo url_for('sessions/uploads') ?>">Upload Sessions</a></li>   
        <?php endif ?>

        <li class="sf_admin_action_previous"><a href="<?php echo url_for('ProjectCategory/show?id='.$sf_user->getAttribute('dropid')) ?>">Back</a></li>    </ul>
    </form>
   </div>

