<?php $final=$sf_user->getAttribute('final');
?> 
<form action="<?php echo url_for('sbtm/reviewsubmit') ?>" method="post">
<table>
<thead>
<tr> 
    <th> 
<textarea rows="20" cols="100" name="quote" wrap="physical"><?php echo $sf_user->getAttribute('theData') ?></textarea>
    </th>
      
    <th class="sf_admin_batch_actions_choice">
    <select name="status_action">
    <option value="">Choose an action</option>
    <?php foreach ($status as $stat): 
    $value=$stat->getName();
      if($final=='yes' && ($value == 'Submitted' || $value== 'Finalize')){?> 
    <option value="<?php echo $value?>"><?php echo $stat->getName()?></option>
    <?php } elseif ($final!='yes') {?><option value="<?php echo $value?>"><?php echo $stat->getName()?></option> <?php }  endforeach; ?> 
    </select>
    </th>
    
    <th>        <input type="submit" value=" Submit " /></th>
    </tr>
    </thead>
</table>
</form>