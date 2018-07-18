<!DOCTYPE html>

<html>
	<head>
		<title> BBS </title>  
		<meta http-equiv="content-type" charset="utf-8">
	</head>
	<body>
		<p>BBS</p>
		<hr color=black width="1920" size="10" />
		<form action = "write.php" method="post">
			<input type="text" name="name" placeholder="name"><br>
			<textarea rows="10" cols="50" name="message" placeholder="message"></textarea><br>
			<input type = "submit">
		</form>
		<hr color=black width="1920" size="10" />

		<section>
			<?php
			if(!is_file('BBS.txt')){
				touch('BBS.txt');
			}
			$fp = fopen('BBS.txt', 'r');

			if ($fp){
				if (flock($fp, LOCK_EX)){
					$flug = false;
					$line = "";
					for($cnt = 1,$line = fgets($fp), $commentcnt = 1 ; $flug != true; $cnt++, $line = fgets($fp))
					{
						if ( $line !== FALSE){
							
							if($cnt % 2 == 1){
							echo($commentcnt);echo( " / ");//echo( "</br>");
							echo ("Name : ");
							$commentcnt++;
							}
							else{
							//echo ("comment : </br>");
							//echo ("----------</br>");
							}
str_replace("K1M1SH1M4", "\r\n", $line);
							echo ($line);
							echo("<br/>");
							if($cnt % 2 == 0){
							echo("-----------------------------------------");
							echo("<br/>");
							}
						}else{
						$flug = true;
						}
					}
					flock($fp, LOCK_UN);
				}else{
					print('fileLock NO');
				}
			}
			$flag = fclose($fp);

			if ($flag){
			}else{
				print('close NO');
			}
			?>
		</section>
		<hr color=black width="1920" size="10" />
		<form action = "write.php" method="post">
			<input type="text" name="name" placeholder="name"><br>
			<textarea rows="10" cols="50" name="message" placeholder="message"></textarea><br>
			<input type = "submit">
		</form>
		<hr color=black width="1920" size="10" />

	</body>
</html>