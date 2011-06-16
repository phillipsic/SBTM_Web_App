<div id="sf_admin_container">

<table>
<thead>
<tr> 
    <th> 
        <textarea rows="20" cols="100" name="quote" wrap="physical" readonly="readonly"><?php echo $sf_user->getAttribute('theData') ?></textarea>
    </th>
    <th>      <ul class="sf_admin_actions">
      <li class="sf_admin_action_previous"><a href="<?php echo url_for('sbtm/sessionlist') ?>">Back</a></li>    </ul>
</th>
    </tr>
    </thead>
</table>
</div>

