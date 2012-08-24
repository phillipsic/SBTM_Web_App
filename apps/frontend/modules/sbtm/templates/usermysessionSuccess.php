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
<?php $admin = $sf_user->getAttribute('adminrole');
$admin = $sf_user->getAttribute('adminrole'); ?>
<div id="sf_admin_container">
    <form method="post" action="">
        <titles>My Session</titles>
        <div class="sf_admin_list">
            <table  border="5">
                <?php if ($sessions->count() > 0) {
 ?>
                    <thead>
                        <tr>

                            <th class="sf_admin_text sf_admin_list_th_name">
                                Session Name
                            </th>
                            <th class="sf_admin_text sf_admin_list_th_name">
                                Project
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
<?php } else { ?>
                    <div class="record_error">
                    <?php //$sf_user->getAttributeHolder()->clear();
                    echo 'No record Found'; ?>
                </div>
<?php } ?>
                <tbody>
<?php foreach ($sessions as $session): ?>
                    <tr class="sf_admin_row odd">
                        <td class="sf_admin_text sf_admin_list_td_name">
                            <a href="<?php echo url_for('sessions/show?id=' . $session->getId()) ?>"><?php echo $session->getSessionname() ?></a></td>

                        <?php
                        $project_details = Doctrine_Core::getTable('ProjectCategory')
                                        ->createQuery('a')
                                        ->where('a.id = ?', $session->getProject_id())
                                        ->execute();

                        ?>


                        <td class="sf_admin_text sf_admin_list_td_name">
<?php echo $project_details[0] ?></td>

                        <td class="sf_admin_text sf_admin_list_td_name">
<?php echo $session->getStatus() ?></td>


                        <td>
                            <ul class="sf_admin_td_actions">

                                <!--li class="sf_admin_action_edit">
                                <a href="<?php echo url_for('sessions/edit?id=' . $session->getId()) ?>">Edit</a>
                                </li-->
                                <li class="sf_admin_action_delete">
<?php echo link_to('Cancel', 'sessions/cancel?id=' . $session->get('id'), array('post' => true, 'confirm' => 'Are you sure?')) ?>
                                </li>

<?php if ($session->getStatus() == "Finalize") { ?>
                                <li class="sf_admin_action_edit">
                                    <a href="<?php echo url_for('sessions/review?name=' . $session->getSessionname() . '&id=' . $session->getId() . '&final=yes' . '&proj=' .$session->getProjectCategory()) ?>">Edit</a>
                                </li>
                                <?php } else {
                                $sf_user->setAttribute('url', 'sbtm/uploads?id=' . $session->getId()); ?>

                                <li class="sf_admin_action_upload">
                                    <a href="<?php echo url_for('sbtm/uploads?id=' . $session->getId()) ?>">Upload</a>
                                </li>
<?php } ?>
                            </ul>
                        </td>
                        <td class="sf_admin_date sf_admin_list_td_created_at">
<?php echo $session->getUpdatedAt() ?></td>
                    </tr>
<?php endforeach; ?> 
                        </tbody>
                    </table>
                </div>
<?php if ($admin == "Admin"): ?>
                                <!--ul class="sf_admin_actions">
                                  <li class="sf_admin_action_new"><a href="<?php echo url_for('sessions/new') ?>">Add Session</a></li>

                                  <li class="sf_admin_action_upload"><a href="<?php echo url_for('sessions/uploads') ?>">Upload Sessions</a></li>    </ul-->
<?php endif ?>
    </form>
</div>

<h2> My Issues </h2>
        <div class="sf_admin_list">
            <table  border="5">
                <?php if ($issues ->count() > 0) {
 ?>
                    <thead>
                        <tr>

                            <th class="sf_admin_text sf_admin_list_th_name">
                                Issue Name
                            </th>
                            <th class="sf_admin_text sf_admin_list_th_name">
                                Project
                            </th>
                            <th class="sf_admin_text sf_admin_list_th_name">
                                Status
                            </th>
                            <th class="sf_admin_date sf_admin_list_th_created_at">
                                Updated at
                            </th>
                        </tr>
                    </thead>
<?php } else { ?>
                    <div class="record_error">
                    <?php //$sf_user->getAttributeHolder()->clear();
                    echo 'No record Found'; ?>
                </div>
<?php } ?>
                    <tbody>
          <?php foreach ($issues as $issue): ?>
            <tr class="sf_admin_row odd">
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $issue->getTitle() ?></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $issue->getProjectCategory() ?></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php echo $issue->getStatus() ?></td>
            <td class="sf_admin_date sf_admin_list_td_created_at">
            <?php echo $issue->getUpdatedAt() ?></td>
            </tr>
           <?php endforeach; ?>
                    </tbody>
</table>
</div>
