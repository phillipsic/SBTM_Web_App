<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $role->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $role->getName() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $role->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $role->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('role/edit?id='.$role->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('role/index') ?>">List</a>
