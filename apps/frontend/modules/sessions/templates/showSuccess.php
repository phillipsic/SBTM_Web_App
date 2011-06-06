<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $sessions->getId() ?></td>
    </tr>
    <tr>
      <th>Sessionname:</th>
      <td><?php echo $sessions->getSessionname() ?></td>
    </tr>
    <tr>
      <th>Charter:</th>
      <td><?php echo $sessions->getCharter() ?></td>
    </tr>
    <tr>
      <th>Areas:</th>
      <td><?php echo $sessions->getAreas() ?></td>
    </tr>
    <tr>
      <th>Testnotes:</th>
      <td><?php echo $sessions->getTestnotes() ?></td>
    </tr>
    <tr>
      <th>Ready:</th>
      <td><?php echo $sessions->getReady() ?></td>
    </tr>
    <tr>
    <th>Status:</th>
      <td><?php echo $sessions->getStatusId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $sessions->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $sessions->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('sessions/edit?id='.$sessions->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('sbtm/sessions') ?>">Back</a>
