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

	$key = strip_tags($_REQUEST['key']);
	$data = array();

	switch($key){
		case  "insert":
			$namaDepan = filter_var($_REQUEST['namaDepan'],FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$namaBelakang = filter_var($_REQUEST['namaBelakang'],FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$jenisKelamin = filter_var($_REQUEST['jenisKelamin'],FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$alamat = filter_var($_REQUEST['alamat'],FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$noTelp = filter_var($_REQUEST['noTelp'],FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$email = filter_var($_REQUEST['email'],FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);

			try {
				$sql = "INSERT INTO biodata(namaDepan, namaBelakang, jenisKelamin, alamat, noTelp, email) 
						VALUES(:namaDepan, :namaBelakang, :jenisKelamin, :alamat, :noTelp, :email)";
				$statement = $pdo->prepare($sql);
				$statement->bindParam(':namaDepan', $namaDepan, PDO::PARAM_STR);
				$statement->bindParam(':namaBelakang', $namaBelakang, PDO::PARAM_STR);
				$statement->bindParam(':jenisKelamin', $jenisKelamin, PDO::PARAM_STR);
				$statement->bindParam(':alamat', $alamat, PDO::PARAM_STR);
				$statement->bindParam(':noTelp', $noTelp, PDO::PARAM_INT);
				$statement->bindParam(':email', $email, PDO::PARAM_STR);
				$statement->execute();

				echo json_encode(array('message' => 'Biodata dengan nama '.$namaDepan.' telah disimpan'));
			}

			catch(PDOException $e){
				echo $e->getMessage();
			}
			break;

		case "update":
			$namaDepan = filter_var($_REQUEST['namaDepan'],FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$namaBelakang = filter_var($_REQUEST['namaBelakang'],FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$jenisKelamin = filter_var($_REQUEST['jenisKelamin'],FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$alamat = filter_var($_REQUEST['alamat'],FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$noTelp = filter_var($_REQUEST['noTelp'],FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$email = filter_var($_REQUEST['email'],FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
			$idBiodata = filter_var($_REQUEST['idBiodata'],FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);

			try {
				$sql = "UPDATE biodata SET namaDepan = :namaDepan, namaBelakang = :namaBelakang, jenisKelamin = :jenisKelamin, alamat = :alamat, 
						noTelp = :noTelp, email = :email WHERE idBiodata = :idBiodata";
				$statement = $pdo->prepare($sql);
				$statement->bindParam(':namaDepan', $namaDepan, PDO::PARAM_STR);
				$statement->bindParam(':namaBelakang', $namaBelakang, PDO::PARAM_STR);
				$statement->bindParam(':jenisKelamin', $jenisKelamin, PDO::PARAM_STR);
				$statement->bindParam(':alamat', $alamat, PDO::PARAM_STR);
				$statement->bindParam(':noTelp', $noTelp, PDO::PARAM_INT);
				$statement->bindParam(':email', $email, PDO::PARAM_STR);
				$statement->bindParam(':idBiodata', $idBiodata, PDO::PARAM_INT);
				$statement->execute();

				echo json_encode('Biodata dengan nama '.$namaDepan.' telah diupdate');
			}

			catch(PDOException $e){
				echo $e->getMessage();
			}
			
			break;

			case "hapus":

				$idBiodata = filter_var($_REQUEST['idBiodata'],FILTER_SANITIZE_NUMBER_INT);

				try{
					$pdo 	= new PDO($dest, $username, $password);
					$sql 	= "DELETE FROM biodata WHERE idBiodata = :idBiodata";
					$statement = $pdo->prepare($sql);
					$statement->bindParam(':idBiodata', $idBiodata, PDO::PARAM_INT);
					$statement->execute();

					echo json_encode('Biodata dengan nama '.$namaDepan.' telah dihapus');
				}

				catch(PDOException $e){
					echo $e->getMessage();
				}

		break;

	}
?>