<div id="sf_admin_container">
    <form method="post" action="<?php echo url_for('dashboard/alldropdashboard') ?>">
        <titles>All Drop Dashboard</titles>
        <div class="sf_admin_list" style="overflow:auto; width:770px; height: 300px;">
            <table  border="5">
                <?php if ($sessions->count() > 0) {
                ?>
                    <thead>
                        <tr>
                            <th class="sf_admin_text sf_admin_list_th_name">
                                Drop Name
                            </th>
                            <th class="sf_admin_text sf_admin_list_th_name">
                                ToDo
                            </th>
                            <th class="sf_admin_text sf_admin_list_th_name">
                                Running
                            </th>
                            <th class="sf_admin_text sf_admin_list_th_name">
                                Finalise
                            </th>
                            <th class="sf_admin_text sf_admin_list_th_name">
                                Submitted
                            </th>
                            <th class="sf_admin_text sf_admin_list_th_name">
                                Approved
                            </th>
                        </tr>
                    </thead>
                <?php } else {
 ?>
                    <div class="record_error">
                    <?php
                    //$sf_user->getAttributeHolder()->clear();
                    echo 'Approved Sessions ';
                    echo 'No record Found';
                    ?>
                    </div>
                    <?php } ?>
                <tbody>
<?php foreach ($sessions as $session): ?>
                    <tr class="sf_admin_row odd">
                        <td class="sf_admin_text sf_admin_list_td_name">
                            <a href="<?php echo url_for('sessions/show?id=' . $session->getId()) ?>"><?php echo $session->getSessionname() ?></a></td>
                        <td class="sf_admin_text sf_admin_list_td_name">
                            <?php echo $session->getReady() ?></td>
                        <td class="sf_admin_text sf_admin_list_td_name">
                            <?php echo $session->getStatus() ?></td>
                        <td class="sf_admin_date sf_admin_list_td_created_at">
<?php echo $session->getCreatedAt() ?></td>

                        <td class="sf_admin_date sf_admin_list_td_created_at"></td>
                        <td class="sf_admin_date sf_admin_list_td_created_at"></td>

                    </tr>

<?php endforeach; ?>
                </tbody>
            </table>
        </div>




    </form>
</div>

