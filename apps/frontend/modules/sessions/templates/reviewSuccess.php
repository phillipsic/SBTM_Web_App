<?php $final=$sf_user->getAttribute('final');
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

<form action="<?php echo url_for('sbtm/reviewsubmit') ?>" method="post" onsubmit='return formValidator()'>
<table>
<thead>
<tr> 
    <th> 
<textarea rows="20" cols="100" name="quote" wrap="physical"><?php echo $sf_user->getAttribute('theData') ?></textarea>
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