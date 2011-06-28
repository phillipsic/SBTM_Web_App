<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('ProjectCategory/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
            <?php if($sf_user->getAttribute('new')!='yes'){?>
          &nbsp;<a href="<?php echo url_for('sbtm/projectadmin') ?>">
              <?php  } else{ ?>
               &nbsp;<a href="<?php echo url_for('sbtm/logout') ?>">
             <?php }?>
              Cancel</a>
          <?php if (!$form->getObject()->isNew() && $form->getObject()->getName()!=$sf_user->getAttribute('project')): ?>
            &nbsp;<?php echo link_to('Delete', 'ProjectCategory/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>
