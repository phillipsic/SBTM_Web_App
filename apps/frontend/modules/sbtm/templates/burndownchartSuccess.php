<div id="sf_admin_container">
<titles>Burn Down Chart Report</titles>

<table  border="2">
      <tbody>
             <tr class="sf_admin_row odd">
            <td class="sf_admin_text sf_admin_list_td_id">
           <?php stOfc::createChart( 500, 250, 'sbtm/lineChartData', false ); ?></td>
            <td class="sf_admin_text sf_admin_list_td_name">
            <?php stOfc::createChart( 500, 250, 'sbtm/pieChartData', false ); ?></td>
          </tr>
        </tbody>
    </table>
</div>


