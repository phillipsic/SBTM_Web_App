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
      <thead>
        <tr>
          <th id="sf_admin_list_batch_actions">
              <input type="checkbox" onclick="checkAll();" id="sf_admin_list_batch_checkbox">
          </th>
          <th class="sf_admin_text sf_admin_list_th_id">
            Id
          </th>
          <th class="sf_admin_text sf_admin_list_th_name">
           Name
          </th>
           <th class="sf_admin_date sf_admin_list_th_created_at">
            Start Date
           </th>
           <th class="sf_admin_date sf_admin_list_th_updated_at">
            End Date
           </th>
           <th class="sf_admin_text sf_admin_list_th_name">
           Completed Status
          </th>
          <th id="sf_admin_list_th_actions">Actions</th>
        </tr>
      </thead>
      
      <tbody>
          <?php foreach ($project_category as $project): ?>
            <tr class="sf_admin_row odd">
            <td>
            <input type="checkbox" class="sf_admin_batch_checkbox" value=<?php echo $project->getId() ?> name="ids[]">
            </td>
            <td class="sf_admin_text sf_admin_list_td_id">
            <a href="<?php echo url_for('ProjectCategory/show?id='.$project->getId()) ?>"><?php echo $project->getId() ?></a></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <a href="<?php echo url_for('ProjectCategory/show?id='.$project->getId()) ?>"><?php echo $project->getName() ?></a></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $project->getStartdate() ?></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $project->getEnddate() ?></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php if($project->getCompletetag()==''){echo 'No';} else{echo 'Yes';} ?></td>
            <td>
            <ul class="sf_admin_td_actions">
            <li class="sf_admin_action_edit">
            <a href="<?php echo url_for('Projectcategory/edit?id='.$project->getId()) ?>">Edit</a>
            </li>  
            <li class="sf_admin_action_delete">
            <?php echo link_to('Delete', 'Projectcategory/delete?id='.$project->get('id'), array('post' => true, 'confirm' => 'Are you sure?')) ?>
            </li> 
            </ul>
            </td>
          </tr>
          <?php endforeach; ?> 
        </tbody>
    </table>
  </div>

    <ul class="sf_admin_actions">
      <li class="sf_admin_action_new"><a href="<?php echo url_for('Projectcategory/new') ?>">create New project</a></li>    </ul>
    </form>
  </div>

