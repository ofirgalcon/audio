<div id="audio-tab"></div>
<h2 data-i18n="audio.audio"></h2>

<p>
<table class="audio table table-striped table-bordered">
	<thead>
		<tr>
          <th data-i18n="audio.name"></th>
          <th data-i18n="audio.default_audio_output"></th>
          <th data-i18n="audio.default_audio_input"></th>
          <th data-i18n="audio.device_input"></th>
          <th data-i18n="audio.device_output"></th>
          <th data-i18n="audio.device_srate"></th>
          <th data-i18n="audio.device_manufacturer"></th>
          <th data-i18n="audio.device_transport"></th>
		</tr>
	</thead>
	<tbody>
	<?php $audioitemobj = new audio_model(); ?>
	<?php foreach($audioitemobj->retrieveMany('serial_number=?', array($serial_number)) as $item): ?>
	<?php $name_url=url('show/listing/audio/audio#'. rawurlencode($item->name)); ?>
        <tr>
          <td><?php echo $item->name; ?></td>
          <td><?php echo $item->default_audio_output; ?></td>
          <td><?php echo $item->default_audio_input; ?></td>
          <td><?php echo $item->device_input; ?></td>
          <td><?php echo $item->device_output; ?></td>
          <td><?php echo $item->device_srate; ?></td>
          <td><?php echo $item->device_manufacturer; ?></td>
          <td><?php echo $item->device_transport; ?></td>
        </tr>
	<?php endforeach; ?>

	</tbody>
</table>

<script>
  $(document).on('appReady', function(e, lang) {

        // Initialize datatables
            $('.audio').dataTable({
                "bServerSide": false,
                "aaSorting": [[0,'asc']],
                "fnDrawCallback": function( oSettings ) {
                $('#audio-cnt').html(oSettings.fnRecordsTotal());
              }
            });
  });
</script>
