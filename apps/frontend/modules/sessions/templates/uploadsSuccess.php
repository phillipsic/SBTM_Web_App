<div id="sf_admin_container">   
    <titles>Upload sessions for <?php echo $sf_user->getAttribute('projectname') ?></titles>
<form enctype="multipart/form-data" action="<?php echo url_for('sessions/upload') ?>" method="POST">
<div class="sf_admin_list">
    <table>
        <thead>
            <tr>
<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
<th class="sf_admin_text sf_admin_list_th_name">
Choose a file to upload: </th> <th class="sf_admin_text sf_admin_list_th_name"><input name="uploadedfile" type="file" /></th>
</tr></thead>
    <tbody>
    <td class="sf_admin_text sf_admin_list_td_name">
</td><td>
<ul class="sf_admin_td_actions">
<li class="sf_admin_action_delete">
            <?php echo link_to('Cancel', 'sbtm/sessions', array('post' => true, 'confirm' => 'Are you sure?')) ?>
</li> <li><input type="submit" value="Upload File" /></li>
            </ul></td>
 </tbody>
</table>
 </div>
</form>
</div>

