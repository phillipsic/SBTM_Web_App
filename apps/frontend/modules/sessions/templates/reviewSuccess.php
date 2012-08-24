<?php $final=$sf_user->getAttribute('final');
      $dirname=$sf_user->getAttribute('dirname');
?> 

<script type='text/javascript'>

function formValidator(){
	// Make quick references to our fields
	var status = document.getElementById('status_action');
	// Check each input in the order that it appears in the form!

				if(madeSelection(status, "Please Choose an action")){
								return true;
						}

	
	
	return false;
	
}
function madeSelection(elem, helperMsg){
	if(elem.value == ""){
		alert(helperMsg);
		elem.focus();
		return false;
	}else{
		return true;
	}
}

</script>
<?php if ($sf_user->hasAttribute('errorarr')): ?> 
          <div id="err" class="flash_error">
              <table>
<thead>

            <?php //$sf_user->getAttributeHolder()->clear();
            $errors=array();
            $errors=$sf_user->getAttribute('errorarr');
          if (count($errors)>0){
            foreach ($errors as $r=>$err):?>
    <tr><th>
                <?php echo ($r+1).". ".$err;?></th>
    </tr>
                <?php
            endforeach; 
          }
          
          $sf_user->getAttributeHolder()->remove('errorarr');?>
              </table>
          </thead>
          </div>
        <?php endif ?>
<form action="<?php echo url_for('sbtm/reviewsubmit?proj='.$dirname) ?>" method="post" onsubmit='return formValidator()'>
<table>
<thead>
<tr> 
    <th> 
<textarea rows="20" cols="100" name="quote" wrap="physical"><?php echo file_get_contents($sf_user->getAttribute('theData')) ?></textarea>
    </th>
      
    <th class="sf_admin_batch_actions_choice">
    <select name="status_action" id="status_action">
    <option value="">Choose an action</option>
    <?php foreach ($status as $stat): 
    $value=$stat->getName();
      if($final=='yes' && ($value == 'Submitted' || $value== 'Finalize')){?> 
    <option value="<?php echo $value?>"><?php echo $stat->getName()?></option>
    <?php } elseif ($final!='yes' && ($value == 'Approved' || $value== 'Finalize') ) {?><option value="<?php echo $value?>"><?php echo $stat->getName()?></option> <?php }  endforeach; ?> 
    </select>
    </th>
    
    <th>        <input type="submit" value=" Submit "  /></th>
    </tr>
    </thead>
</table>
</form>
<div class="sf_admin_list" style="overflow:auto; width:770px; height: 200px;">
    <table  border="5">
    <?php if (count($disp_issue)>0){ ?>
            <thead>
        <tr>
            <th class="sf_admin_text sf_admin_list_th_name">
                Issue ID
            </th>
            <th class="sf_admin_text sf_admin_list_th_name">
                Description
            </th>
            <th id="sf_admin_list_th_actions">
                Actions
            </th>
        </tr>
    </thead>
    <?php } else{ ?>
    <div class="record_error">
         <?php
        echo "ISSUES <br>\n";
        echo 'No Issues Found'; ?>
    </div>
     <?php }  ?>
    <tbody>
        <?php foreach($disp_issue as $issue): ?>
        <tr class="sf_admin_row odd">
            <td class="sf_admin_text sf_admin_list_td_id">
                 <?php echo $issue ?></td>
            <td class="sf_admin_text sf_admin_list_td_name">
                <?php echo $issue ?></td>
            <td>
                 <ul class="sf_admin_td_actions">
                     <li class="sf_admin_action_create">
                         <a href="<?php echo url_for('Issues/New') ?>">Create</a>
                     </li>
                     <li class="sf_admin_action_delete">
                        <a href="<?php echo url_for('Issues/New') ?>">Ignore</a>
                    </li>
                </ul>
            </td>
        </tr>
         <?php endforeach; ?>
    </tbody>
</table>

</div>