<table border="1">
    <tr>
        <td  width="30">
<!--            <input type="text"  />
-->       
Month
 </td>
        <td >Planned</td>
        <td>Cum.Planned</td>
        <td>Actual</td>
        <td>Cum.Actual</td>
    </tr>
    <tr>
        <td >Jan 2016</td>
        <td contenteditable="true" class="initial-val">2</td>
        <td contenteditable="true" class="initial-val">3</td>
        <td data-formula='val/2'></td>
		<td data-formula='val/2'></td>
    </tr>
    <tr>
        <td >Feb 2016</td>
        <td contenteditable="true" class="initial-val">4</td>
        <td contenteditable="true" class="initial-val">5</td>
        <td data-formula='val*(15/5)'></td>
		<td data-formula='val/2'></td>        
    </tr>
    
    <tr>
        <td >Mar 2016</td>
        <td contenteditable="true" class="initial-val">6</td>
        <td contenteditable="true" class="initial-val">7</td>
        <td data-formula='val*(20/5)'></td>
		<td data-formula='val/2'></td>        
    </tr>
    
    <tr>
        <td >Apr 2016</td>
        <td contenteditable="true" class="initial-val">1</td>
        <td contenteditable="true" class="initial-val">2</td>
        <td data-formula='val*(35/5)'></td>
		<td data-formula='val/2'></td>        
    </tr>
    
    <tr>
        <td >May 2016</td>
        <td contenteditable="true" class="initial-val">4</td>
        <td contenteditable="true" class="initial-val">5</td>
        <td data-formula='val*(15/5)'></td>
		<td data-formula='val/2'></td>        
    </tr>
</table>

        <script src="<?php echo base_url()?>assets/front/global/plugins/jquery.min.js" type="text/javascript"></script>

<script>
$(function () {

    function isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    var $input = $('.initial-val'),
        $cells = $('td[data-formula]');

    $('.initial-val').on('keyup', function () {
		//var id = $(this).closest('td').attr('id');
        var val = $(this).text();

        if (isNumber(val)) {
            $.each($cells, function () {
                var $thisCell = $(this);
                $thisCell.text(
                    eval($thisCell.attr('data-formula').replace('val', val.toString()))
                )
            });
        } else {
            $cells.text('ERROR')
        }

    });

});
</script>