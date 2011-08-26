<?php if ($sf_user->hasAttribute('error')): ?> 
          <div class="flash_error">
            <?php //$sf_user->getAttributeHolder()->clear();
            echo $sf_user->getAttribute('error'); 
            
            ?>
          </div>
        <?php endif ?>
<div id="sf_admin_container"> 
    <titles>Upload Template File </titles>
<form enctype="multipart/form-data" action="<?php echo url_for('sbtm/uploadtemplate') ?>" method="POST">
<div class="sf_admin_list">
    <table>
        <thead>
            <tr>

<th class="sf_admin_text sf_admin_list_th_name">
Choose a file to upload: </th> <th class="sf_admin_text sf_admin_list_th_name"><input name="uploadedfile" type="file" /></th>
</tr></thead>
    <tbody>
    <td class="sf_admin_text sf_admin_list_td_name">
</td><td>
<ul class="sf_admin_td_actions">
<li class="sf_admin_action_delete">
            <?php echo link_to('Cancel', 'sbtm/managetemplate', array('post' => true, 'confirm' => 'Are you sure?')) ?>
</li> <li><input type="submit" value="Upload File" /></li>
            </ul></td>
 </tbody>
</table>
 </div>
</form>
</div>

