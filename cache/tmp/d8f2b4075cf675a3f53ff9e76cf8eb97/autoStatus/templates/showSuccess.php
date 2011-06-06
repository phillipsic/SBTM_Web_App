<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $status->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $status->getName() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $status->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $status->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('status/edit?id='.$status->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('status/index') ?>">List</a>
