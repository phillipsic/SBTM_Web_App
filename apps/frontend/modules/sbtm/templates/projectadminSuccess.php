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
            Created at
           </th>
           <th class="sf_admin_date sf_admin_list_th_updated_at">
            Updated at
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
            <a href="<?php echo url_for('sbtm/show?id='.$project->getId()) ?>"><?php echo $project->getId() ?></a></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $project->getName() ?></td>
            <td class="sf_admin_date sf_admin_list_td_created_at">
            <?php echo $project->getCreatedAt() ?></td>
            <td class="sf_admin_date sf_admin_list_td_updated_at">
            <?php echo $project->getUpdatedAt() ?></td>
            <td>
            <ul class="sf_admin_td_actions">
            <li class="sf_admin_action_edit"><a href="/backend_dev.php/category/1/edit">Edit</a></li>    <li class="sf_admin_action_delete"><a href="/backend_dev.php/category/1" onclick="if (confirm('Are you sure?')) { var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'post'; f.action = this.href;var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', 'sf_method'); m.setAttribute('value', 'delete'); f.appendChild(m);var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', '_csrf_token'); m.setAttribute('value', '7ff886bdfe2685bcac278e510c309b06'); f.appendChild(m);f.submit(); };return false;">Delete</a></li> 
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
      <li class="sf_admin_action_new"><a href="/frontend_dev.php/Projectcategory/new">create New project</a></li>    </ul>
    </form>
  </div>
  <!--a href="<?php echo url_for('sbtm/new') ?>">New</a-->
