<h1>Loginss List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Username</th>
      <!--th>Password</th-->
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
      <td><a href="<?php echo url_for('login/show?id='.$logins->getId()) ?>"><?php echo $logins->getId() ?></a></td>
      <td><?php echo $logins->getName() ?></td>
      <td><?php echo $logins->getUsername() ?></td>
      <td><?php echo $logins->getEmail() ?></td>
      <td><?php echo $logins->getRole() ?></td>
      <td><?php if($logins->getIslocked()==''){echo 'No';} else{echo 'Yes';} ?></td>
      <td><?php echo $logins->getCreatedAt() ?></td>
      <td><?php echo $logins->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('login/new') ?>">New</a>
