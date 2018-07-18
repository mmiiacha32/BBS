<?php

if(!is_file('BBS.txt')){
	touch('BBS.txt');
}
$fp = fopen('BBS.txt', 'a');

if ($fp){
	if (flock($fp, LOCK_EX)){					
		$cnt = fgets($fp);
		//ftruncate ( $fp , 0 );
		//fseek ( $fp , 0 );
		if (fwrite($fp,  $_POST["name"]. PHP_EOL) === FALSE){
			print('name NO');
		}else{
			print('name OK');
		}
		if (fwrite($fp,  $_POST["message"]. PHP_EOL) === FALSE){
			print('message NO');
		}else{
			print('message OK');
		}

		flock($fp, LOCK_UN);
	}else{
		print('fileLock NO');
	}
}
$flag = fclose($fp);

if ($flag){
	print('close OK');
}else{
	print('close NO');
}
