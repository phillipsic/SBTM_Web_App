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
<div id="sf_admin_container">
<form action="<?php echo url_for('sbtm/templatesubmit') ?>" method="post" onsubmit='return formValidator()'>
<titles>Edit Template</titles>
    <table>
<thead>
<tr> 
    <th> 
<textarea rows="20" cols="100" name="quote" wrap="physical" ><?php echo $sf_user->getAttribute('theData') ?></textarea>
    </th>
    
    <th>        <input type="submit" value=" Submit "  /></th>
    </tr>
    </thead>
</table>
</form>
</div>