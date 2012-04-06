<div id="sf_admin_container">
    <form method="post" action="">
        <title>Sessions List </title>
        <div class="sf_admin_list" style="overflow:auto; width:770px; height: 300px;">

            <table  border="5">
                <?php if ($session_result->count()>0){ ?>
                <thead>
                    <tr>
                        <th class="sf_admin_text sf_admin_list_th_name">
                            Session Name
                        </th>
                        <th class="sf_admin_text sf_admin_list_th_name">
                            Project
                        </th>
                        <th class="sf_admin_text sf_admin_list_th_name">
                            Completed Date
                        </th>
                    </tr>
                </thead>
                <?php } else{ ?>
                <div class="record_error">
                   <?php echo 'No record Found'; ?>
                </div>
                <?php } ?>
                <tbody>
                    <?php foreach ($session_result as $ses): ?>
                        <tr class="sf_admin_row odd">

                            <td class="sf_admin_text sf_admin_list_td_id">
                                <a href="<?php echo url_for('sessions/sessionreadonly?name=' . $ses->getSessionname() . '&id=' . $ses->getId()) ?>"><?php echo $ses->getSessionname() ?></a></td>

                            <td class="sf_admin_text sf_admin_list_td_name">
                            <?php echo $ses->getproject_id() ?></td>

                        <td class="sf_admin_text sf_admin_list_td_name">
                            <?php echo $ses->getUpdatedAt() ?></td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


    </form>
</div>

