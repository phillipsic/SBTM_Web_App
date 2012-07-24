<h1>New Issue</h1>
<form action="<?php echo url_for('Issues/Submit') ?>" method="POST">
  <table>
    <?php echo $form ?>
    <tr>
      <td colspan="2">
        <input type="submit" />
      </td>
    </tr>
  </table>
</form>