<div id="sf_admin_container">
    <form method="post" action="">
        <titles>Data Files</titles>
<div class="sf_admin_list" style="overflow:auto; width:770px; height: 200px;">
      <table  border="5">
          <?php $files=array();
          $files=$sf_user->getAttribute('files');
          if (count($files)>0){ ?>
          
      <thead>
        <tr>
          <th class="sf_admin_text sf_admin_list_th_name">
           Data Files
          </th>       
          <th id="sf_admin_list_th_actions">Actions</th>         
         </tr>
      </thead>
      <?php } else{ ?>  
      <div class="record_error">
            <?php //$sf_user->getAttributeHolder()->clear();
            echo 'Data Files ';
            echo 'No record Found'; ?>
          </div>
      <?php }  ?> 
      <tbody>
          <?php foreach ($files as $file): ?>
            <tr class="sf_admin_row odd">
            <td class="sf_admin_text sf_admin_list_td_id">
            <?php echo $file ?></td>
            <td><li class="sf_admin_action_download">
            <a href="<?php echo url_for('sbtm/downloaddatafiles?name='.$file) ?>">Download</a>
            </li></td>
                        </td>
          </tr>
          <?php endforeach; ?> 
          
        </tbody>
    </table>
  </div>
<ul class="sf_admin_actions">
      <li class="sf_admin_action_new"><a href="<?php echo url_for('sbtm/uploaddatafiles') ?>">Upload Data File</a></li>    </ul>
    </form>
  </div>

