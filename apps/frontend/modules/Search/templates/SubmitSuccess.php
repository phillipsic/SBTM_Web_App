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
                            Status
                        </th>
                        <th class="sf_admin_text sf_admin_list_th_name">
                            Last Updated At
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
                                <?php if ($ses->getstatusId()==4) { ?>
                                      <a href="<?php echo url_for('Search/ReadSearchedSession?name='.$ses->getSessionname().'&id='.$ses->getId().'&proj='.$ses->getProjectCategory()) ?>"><?php echo $ses->getSessionname() ?></a>
                                <?php } else { ?>
                                      <?php echo $ses->getSessionname() ?>
                                 <?php } ?>
                            </td>
                            <td class="sf_admin_text sf_admin_list_td_name">
                            <?php echo $ses->getProjectCategory() ?></td>

                            <td class="sf_admin_text sf_admin_list_td_name">
                            <?php echo $ses->getStatus() ?></td>

                        <td class="sf_admin_text sf_admin_list_td_name">
                            <?php echo $ses->getUpdatedAt() ?></td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


    </form>
</div>

