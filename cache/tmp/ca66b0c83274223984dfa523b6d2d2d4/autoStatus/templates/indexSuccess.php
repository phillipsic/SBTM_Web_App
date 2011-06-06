<h1>Statuss List</h1>

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
    <?php foreach ($statuss as $status): ?>
    <tr>
      <td><a href="<?php echo url_for('status/show?id='.$status->getId()) ?>"><?php echo $status->getId() ?></a></td>
      <td><?php echo $status->getName() ?></td>
      <td><?php echo $status->getCreatedAt() ?></td>
      <td><?php echo $status->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('status/new') ?>">New</a>
