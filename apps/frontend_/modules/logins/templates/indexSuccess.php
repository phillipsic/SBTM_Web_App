<h1>Loginss List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Username</th>
      <th>Password</th>
      <th>Email</th>
      <th>Role</th>
      <th>Islocked</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($loginss as $logins): ?>
    <tr>
      <td><a href="<?php echo url_for('logins/show?id='.$logins->getId()) ?>"><?php echo $logins->getId() ?></a></td>
      <td><?php echo $logins->getName() ?></td>
      <td><?php echo $logins->getUsername() ?></td>
      <td><?php echo $logins->getPassword() ?></td>
      <td><?php echo $logins->getEmail() ?></td>
      <td><?php echo $logins->getRoleId() ?></td>
      <td><?php echo $logins->getIslocked() ?></td>
      <td><?php echo $logins->getCreatedAt() ?></td>
      <td><?php echo $logins->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('logins/new') ?>">New</a>
