<?php $sf_user->getAttributeHolder()->clear();?>
<div id="sf_admin_container"> 
<form action="<?php echo url_for('sbtm/login') ?>" method="post">
<table  >
    <thead>
        <tr>
<th class="sf_admin_text sf_admin_list_th_name">
 SBTM Web Application 
</th>
<th>
        </th>
</tr>
    <tr>
        <th>
        <label>UserName :</label>
        </th>
        <th>
        <input type="text" name="username"/><br />
        </th>
    </tr>
    <tr>
        <th>
        <label>Password :</label>
        </th>
        <th>
        <input type="password" name="password"/><br/>
        </th>
    </tr>

    <tr> 
        <th>
           <label> Select project :</label>
        </th>
    <th class="sf_admin_batch_actions_choice">
    <select name="project_action">
    <option value="">Choose an action</option>
    <option value="newproject">New project</option>
    <?php foreach ($project_category as $project): 
    $value=$project->getName();?> 
    <option value="<?php echo $value?>"><?php echo $project->getName()?></option>
    <?php endforeach; ?> 
    </select>
    </th>
    </tr>
    
    <tr>
        <th>
        </th>
        <th>        <input type="submit" value=" Login " /><br />
</th>
    </tr>
    </thead>
</table>

</form>
</div>



 
