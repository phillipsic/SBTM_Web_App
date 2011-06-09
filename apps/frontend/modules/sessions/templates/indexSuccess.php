<h1>Sessionss List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Sessionname</th>
      <th>Charter</th>
      <th>Areas</th>
      <th>Testnotes</th>
      <th>Ready</th>
      <th>Tester</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($sessionss as $sessions): ?>
    <tr>
      <td><a href="<?php echo url_for('sessions/show?id='.$sessions->getId()) ?>"><?php echo $sessions->getId() ?></a></td>
      <td><?php echo $sessions->getSessionname() ?></td>
      <td><?php echo $sessions->getCharter() ?></td>
      <td><?php echo $sessions->getAreas() ?></td>
      <td><?php echo $sessions->getTestnotes() ?></td>
      <td><?php echo $sessions->getReady() ?></td>
      <td><?php echo $sessions->getTester() ?></td>
      <td><?php echo $sessions->getCreatedAt() ?></td>
      <td><?php echo $sessions->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('sessions/new') ?>">New</a>
