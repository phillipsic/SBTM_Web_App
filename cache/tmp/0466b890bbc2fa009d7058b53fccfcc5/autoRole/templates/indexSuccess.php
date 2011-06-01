<h1>Roless List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($roless as $roles): ?>
    <tr>
      <td><a href="<?php echo url_for('role/show?id='.$roles->getId()) ?>"><?php echo $roles->getId() ?></a></td>
      <td><?php echo $roles->getName() ?></td>
      <td><?php echo $roles->getCreatedAt() ?></td>
      <td><?php echo $roles->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('role/new') ?>">New</a>
