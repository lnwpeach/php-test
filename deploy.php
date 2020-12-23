<?php
if( $_GET["k"]=="297afdaffb515f637cf42a5e6a45fc8b6cd9f02061c55e9426fe6e6fed513a5792b1d2c8b5ff45f2f556a1c7355b556caddf3edf64bbccd0679a58f8c91d99ca" ){
	echo "<pre>";
	system("sudo git pull origin master");
	echo "</pre>";
}else{
	header("Location: index.php");
}
?>
