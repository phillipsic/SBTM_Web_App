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
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('ProjectCategory/edit?id='.$project_category->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('sbtm/projectadmin') ?>">Back</a>
