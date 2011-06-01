<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $project_category->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $project_category->getName() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $project_category->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $project_category->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('ProjectCategory/edit?id='.$project_category->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('ProjectCategory/index') ?>">List</a>
