<?php
//yandex http-notification
$secret='';

if ($_POST) {
$params='notification_type&operation_id&amount&currency&datetime&sender&codepro';

$params=explode('&',$params);
$forHASH=array();
foreach($params as $key=>$p) {
 if (isset($_POST[$p])) array_push($forHASH,$_POST[$p]);
}

if ($secret!="") array_push($forHASH,$secret);
if (isset($_POST['label'])) array_push($forHASH,$_POST['label']);

$forHASH=implode('&',$forHASH);

if ($_POST['sha1_hash']===sha1($forHASH) && $_POST['codepro']!=='true') { //transact ok.
         ////////////////////////////////
         ///////  Платёж прошел /////////
         ////////////////////////////////
		   $datetime=$_POST['datetime'];
           $status="Успешно!";
           $id=$_POST['label'];
           $money=$_POST['amount'];
           $tranid=$_POST["operation_id"];
           $ymfrom=$_POST['sender'];

          /*что-то делаем....*/
		  
		  	$message = "Дата: $datetime
Идентификатор операции: $tranid
Cтатус: $status
id: $id
сумма: $money
от: $ymfrom
";
	
	
	try {
		$time_record = date("d M Y H:i:s");
		$file_name = "pay.log";
		$f = fopen($file_name, "a");
		flock($f, 2);
		fwrite($f, "Записано в лог: $time_record\n$message\n");
		fclose($f);
	}
	
	catch(Exception $e) {}
		  
		  
		  // file_put_contents('t.txt', array(
		      // $datetime,
			  // $money,
			  // $status,
			  // $id,
			  // $tranid,
			  // $ymfrom, PHP_EOL
		  // ), FILE_APPEND);

         ////////////////////////////////
  }
}