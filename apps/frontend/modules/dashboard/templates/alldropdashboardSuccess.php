<div id="sf_admin_container">
    <form method="post" action="<?php echo url_for('dashboard/alldropdashboard') ?>">
        <titles>All Drop Dashboard</titles>
        <div class="sf_admin_list" style="overflow:auto; width:770px; height: 300px;">

            <center>
            <table  border="5">
                <?php if ($sessions->count() > 0) {
                ?>
                    <thead>
                        <tr>
                            <th class="sf_admin_text sf_admin_list_th_name">
                                Drop Name
                            </th>
                            <th class="sf_admin_text sf_admin_list_th_name">
                                <?php echo $status[0] ?>
                            </th>
                            <th class="sf_admin_text sf_admin_list_th_name">
                                <?php echo $status[2] ?>
                            </th>
                            <th class="sf_admin_text sf_admin_list_th_name">
                                <?php echo $status[4] ?>
                            </th>
                            <th class="sf_admin_text sf_admin_list_th_name">
                                <?php echo $status[1] ?>
                            </th>
                            <th class="sf_admin_text sf_admin_list_th_name">
                                <?php echo $status[3] ?>
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
                    <?php
                    $current_project_id = 0;
                    $Totals_Array[1] = 0;
                    $Totals_Array[3] = 0;
                    $Totals_Array[5] = 0;
                    $Totals_Array[2] = 0;
                    $Totals_Array[4] = 0;
                    foreach ($sessions as $session):




                        if ($current_project_id != $session->getProjectid() && $current_project_id != 0) {
                    ?>
                            <tr class="sf_admin_row odd">
                                <td class="sf_admin_text sf_admin_list_td_name">
                            <?php echo $Project_Name ?></td>
                        <td class="sf_admin_text sf_admin_list_td_name">
                            <?php echo $Totals_Array[1] ?></td>
                        <td class="sf_admin_text sf_admin_list_td_name">
                            <?php echo $Totals_Array[3] ?></td>
                        <td class="sf_admin_date sf_admin_list_td_created_at">
                            <?php echo $Totals_Array[5] ?></td>

                        <td class="sf_admin_date sf_admin_list_td_created_at">
                            <?php echo $Totals_Array[2] ?></td>
                        <td class="sf_admin_date sf_admin_list_td_created_at">
                            <?php echo $Totals_Array[4] ?></td>

                    </tr>
                    <?php
                            $current_project_id = $session->getProjectid();


                            $Project_Name = $session->getProjectname();
                            $Totals_Array[1] = 0;
                            $Totals_Array[3] = 0;
                            $Totals_Array[5] = 0;
                            $Totals_Array[2] = 0;
                            $Totals_Array[4] = 0;

                            $Totals_Array[$session->getStatusid()] = $session->getTotalcount();
                        } else {

                            $current_project_id = $session->getProjectid();


                            $Project_Name = $session->getProjectname();

                            $Totals_Array[$session->getStatusid()] = $session->getTotalcount();
                        } ?>


                    <?php endforeach; ?>

                      <tr class="sf_admin_row odd">
                                <td class="sf_admin_text sf_admin_list_td_name">
                            <?php echo $Project_Name ?></td>
                        <td class="sf_admin_text sf_admin_list_td_name">
                            <?php echo $Totals_Array[1] ?></td>
                        <td class="sf_admin_text sf_admin_list_td_name">
                            <?php echo $Totals_Array[3] ?></td>
                        <td class="sf_admin_date sf_admin_list_td_created_at">
                            <?php echo $Totals_Array[5] ?></td>

                        <td class="sf_admin_date sf_admin_list_td_created_at">
                            <?php echo $Totals_Array[2] ?></td>
                        <td class="sf_admin_date sf_admin_list_td_created_at">
                            <?php echo $Totals_Array[4] ?></td>

                    </tr>



                </tbody>
            </table>
        </center>
        </div>




    </form>
</div>

