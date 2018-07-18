<?php
// 処理完了フラグ
$CompleteFlag = true;

// ファイル読み込み
if(!is_file('BBS.txt')){
  touch('BBS.txt');
}
// ファイルオープン
$fp = fopen('BBS.txt', 'a');

if ($fp)
{
    if (flock($fp, LOCK_EX))
    {
        // 入力欄の長さを取得
	$namelength = strlen ( $_POST["name"] );	// 名前
        $commentlength =strlen ( $_POST["message"] );	// 本文

        // どちらも入力されている場合の処理
	if($namelength != 0 && $commentlength != 0)
        {
//$name
$comment = $_POST["message"];
$order   = array("\r\n", "\n", "\r");
str_replace($order, "K1M1SH1M4", $comment);
//$comment = $comment."\r\n";
//var_dump($comment);
//exit;
            // 名前の書き込み
	    if (fwrite($fp,  $_POST["name"]. PHP_EOL) === FALSE)
            {
                // 書き込みに失敗した場合の処理
		print('name NO');
                $CompleteFlag = false;
            }

	    // 本文の書き込み
            //if (fwrite($fp,  $_POST["message"]) === FALSE)	//. PHP_EOL
            if (fwrite($fp,  $comment) === FALSE)	//. PHP_EOL
            {
                // 本文の書きこみに失敗した場合の処理
		print('message NO');
                $CompleteFlag = false;
            }

            // ファイルのアンロック
	    if(!flock($fp, LOCK_UN))
            {
                // ファイルのアンロックに失敗した場合の処理
		print('fileLock NO');
                $CompleteFlag = false;
            }
        }
	
	// 何かしらが入力されていない場合の処理
        else
        {
            echo("name or comment is NULL");
            $CompleteFlag = false;
        }
	
	// ファイルクローズ
        $flag = fclose($fp);
	    
	// ファイルクローズに失敗した場合の処理
	if (!$flag)
	{
	    print('close NO');
	    $CompleteFlag = false;
	}

	// 何も失敗せずに処理を全て終えた場合の処理
	if($CompleteFlag)
	{
	    header( "Location: BBS.php" );
	    exit;
	}
    }
}
