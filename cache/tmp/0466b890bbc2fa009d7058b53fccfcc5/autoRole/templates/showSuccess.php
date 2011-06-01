<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $roles->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $roles->getName() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $roles->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $roles->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('role/edit?id='.$roles->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('role/index') ?>">List</a>
