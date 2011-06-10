<h1>Project categorys List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Startdate</th>
      <th>Enddate</th>
      <th>Completetag</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($project_categorys as $project_category): ?>
    <tr>
      <td><a href="<?php echo url_for('ProjectCategory/show?id='.$project_category->getId()) ?>"><?php echo $project_category->getId() ?></a></td>
      <td><?php echo $project_category->getName() ?></td>
      <td><?php echo $project_category->getStartdate() ?></td>
      <td><?php echo $project_category->getEnddate() ?></td>
      <td><?php echo $project_category->getCompletetag() ?></td>
      <td><?php echo $project_category->getCreatedAt() ?></td>
      <td><?php echo $project_category->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('ProjectCategory/new') ?>">New</a>
