<?php
// gform_after_submission_{FORM_ID}
add_action( 'gform_after_submission_1', 'after_submission', 10, 2 );

function after_submission( $entry, $form){
	
	if($entry['form_id'] == 1){
                //$entry[{INPUT_ID}] 
		$regNum = $entry[2];
		$state = $entry[3];

		$apiurl = 'http://www.regcheck.org.uk/api/reg.asmx/CheckAustralia?RegistrationNumber='.$regNum.'&State='.$state.'&username=nzkjza';
		$resData = file_get_contents($apiurl);
		$xml = simplexml_load_string($resData);
		$json = json_encode($xml);
	?>
		<script>
            // Use this variable to append data into DOM
            var carData = <?php echo $json; ?>
			console.log(carData);
            // Keep writing stuff here........
            // Enjoy coding.......
		</script>

	<?php
 }
}
