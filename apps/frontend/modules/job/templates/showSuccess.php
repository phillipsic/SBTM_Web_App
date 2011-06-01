<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $logins->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $logins->getName() ?></td>
    </tr>
    <tr>
      <th>Username:</th>
      <td><?php echo $logins->getUsername() ?></td>
    </tr>
    <tr>
      <th>Password:</th>
      <td><?php echo $logins->getPassword() ?></td>
    </tr>
    <tr>
      <th>Email:</th>
      <td><?php echo $logins->getEmail() ?></td>
    </tr>
    <tr>
      <th>Status:</th>
      <td><?php echo $logins->getStatus() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $logins->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $logins->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('job/edit?id='.$logins->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('job/index') ?>">List</a>
