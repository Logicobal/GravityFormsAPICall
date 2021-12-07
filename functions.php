<?php
add_action( 'gform_after_submission_1', 'after_submission', 10, 2 );

function after_submission( $entry, $form){

	if($entry['form_id'] == 1){

		$regNum = $entry[2];
		$state = $entry[3];

		$apiurl = 'http://www.regcheck.org.uk/api/reg.asmx/CheckAustralia?RegistrationNumber='.$regNum.'&State='.$state.'&username=boqicugo11111';
		
		$resData = @file_get_contents($apiurl);
		$xml = simplexml_load_string($resData);
		$json = json_encode($xml);
		echo "uuuuuuuuuuuuuuuuuuuu";
	?>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>
			jQuery(document).ready(function($){
				var data = <?php echo $json; ?>;
				var html = '';
				console.log(data)
				if(data !== false){

				
				var parseData = JSON.parse(data.vehicleJson);
				console.log(parseData);

				html = `

				<div class="items">
					<h3>Make</h3>
					<p>${parseData.CarMake.CurrentTextValue}</p>
				</div>

				<div class="items">
					<h3>Year of Manufacture</h3>
					<p>${parseData.RegistrationYear}</p>
				</div>

				<div class="items">
					<h3>Model</h3>
					<p>${parseData.CarModel.CurrentTextValue}</p>
				</div>

				<div class="items">
					<h3>Purpose</h3>
					<p>${parseData.Purpose}</p>
				</div>
				
				<div class="items">
					<h3>State</h3>
					<p>${parseData.State}</p>
				</div>

				<div class="items">
					<h3>Identification Number</h3>
					<p>${parseData.VechileIdentificationNumber}</p>
				</div>
				`;
				
				// $('#resRegcheck').html(html);
				 
				}else{
					html = `<h4>No car found</h4>`;
				}
				alert('sdsadadsa');
				//setTimeout(function(){ $('window').find('#resRegcheck').html('<h1>This is text!</h1>');alert('bad'); }, 3000);
				setTimeout(function(){$('body').find('#resRegcheck').html(html)}, 300);
				
				
			})
		</script>

	<?php
	
 }

}
