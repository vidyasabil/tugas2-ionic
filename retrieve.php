<?php
	header('Access-Control-Allow-Origin: *');

	$host		='localhost';
	$username	='root';
	$password	='';
	$database	='biodata';
	$charset	='utf8';

	$dest = "mysql:host=".$host.";port=3306;dbname=".$database.";charset=".$charset;

	$option = array(
				PDO:: ATTR_ERRMODE 				=> PDO:: ERRMODE_EXCEPTION,
				PDO:: ATTR_DEFAULT_FETCH_MODE 	=> PDO:: FETCH_OBJ,
				PDO:: ATTR_EMULATE_PREPARES 	=> PDO:: false,
		);

	$pdo = new PDO($dest, $username, $password, $option);
	$data = array();

	try{
		$statement = $pdo->query('SELECT idBiodata, namaDepan, namaBelakang, jenisKelasmin, alamat, noTelp, email FROM biodata ORDER BY namaDepan ASC');
		while($row = $statement->fetch(PDO::FETCH_OBJ)){
			$data[] = $row;
		}

		echo json_encode($data);
	}
	catch(PDOException $e){
		echo $e->getMasssage();
	}

	?>
	}
	}