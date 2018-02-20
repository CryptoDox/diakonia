<?php 
function telecharge ($urlf) {
			//echo "captcha validé !";
			//$urlf = '/home/e-smith/files/ibays/Primary/biblio/D.zip';
			if(file_exists($urlf)) {
   			header('Content-type: application/x-troff-ms');
   			header('Content-Disposition: attachment; filename="nuts_and_bolts_0.3.1.mzp"');
   			readfile($urlf);
		}
	}
?>