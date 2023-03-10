<?php $this->view('partials/head'); ?>

<?php // Initialize models needed for the table
new Machine_model;
new Reportdata_model;
new Audio_model;
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h3><span data-i18n="audio.reporttitle"></span> <span id="total-count" class='label label-primary'>…</span></h3>
            <table class="table table-striped table-condensed table-bordered">
            <thead>
                <tr>
                    <th data-i18n="listing.computername" data-colname='machine.computer_name'></th>
                    <th data-i18n="serial" data-colname='reportdata.serial_number'></th>
                    <th data-i18n="audio.name" data-colname='audio.name'></th>
                    <th data-i18n="audio.default_audio_output" data-colname='audio.default_audio_output'></th>
                    <th data-i18n="audio.default_audio_input" data-colname='audio.default_audio_input'></th>
                    <th data-i18n="audio.device_input" data-colname='audio.device_input'></th>
                    <th data-i18n="audio.device_output" data-colname='audio.device_output'></th>
                    <th data-i18n="audio.device_srate" data-colname='audio.device_srate'></th>
                    <th data-i18n="audio.device_manufacturer" data-colname='audio.device_manufacturer'></th>
                    <th data-i18n="audio.device_transport" data-colname='audio.device_transport'></th>
                </tr>
            </thead>
                <tbody>
                    <tr>
                        <td data-i18n="listing.loading" colspan="10" class="dataTables_empty"></td>
                    </tr>
                </tbody>
            </table>
        </div> <!-- /span 12 -->
    </div> <!-- /row -->
</div>  <!-- /container -->

<script type="text/javascript">

	$(document).on('appUpdate', function(e){

		var oTable = $('.table').DataTable();
		oTable.ajax.reload();
		return;

	});

	$(document).on('appReady', function(e, lang) {

        // Get modifiers from data attribute
        var mySort = [], // Initial sort
            hideThese = [], // Hidden columns
            col = 0, // Column counter
            runtypes = [], // Array for runtype column
            columnDefs = [{ visible: false, targets: hideThese }]; //Column Definitions

        $('.table th').map(function(){

            columnDefs.push({name: $(this).data('colname'), targets: col, render: $.fn.dataTable.render.text()});

            if($(this).data('sort')){
              mySort.push([col, $(this).data('sort')])
            }

            if($(this).data('hide')){
              hideThese.push(col);
            }

            col++
        });

	    oTable = $('.table').dataTable( {
            ajax: {
                url: appUrl + '/datatables/data',
                type: "POST",
                data: function(d){
                     d.mrColNotEmpty = "name";

                    // Check for column in search
                    if(d.search.value){
                        $.each(d.columns, function(index, item){
                            if(item.name == 'audio.' + d.search.value){
                                d.columns[index].search.value = '> 0';
                            }
                        });

                    }
                }
            },
            dom: mr.dt.buttonDom,
            buttons: mr.dt.buttons,
            order: mySort,
            columnDefs: columnDefs,
		    createdRow: function( nRow, aData, iDataIndex ) {
	        	// Update name in first column to link
	        	var name=$('td:eq(0)', nRow).html();
	        	if(name == ''){name = "No Name"};
	        	var sn=$('td:eq(1)', nRow).html();
	        	var link = mr.getClientDetailLink(name, sn, '#tab_audio-tab');
	        	$('td:eq(0)', nRow).html(link);

		    }
	    });

	});
</script>

<?php $this->view('partials/foot'); ?>
