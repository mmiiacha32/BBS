<?php
// ���������t���O
$CompleteFlag = true;

// �t�@�C���ǂݍ���
if(!is_file('BBS.txt')){
  touch('BBS.txt');
}
// �t�@�C���I�[�v��
$fp = fopen('BBS.txt', 'a');

if ($fp)
{
    if (flock($fp, LOCK_EX))
    {
        // ���͗��̒������擾
	$namelength = strlen ( $_POST["name"] );	// ���O
        $commentlength =strlen ( $_POST["message"] );	// �{��

        // �ǂ�������͂���Ă���ꍇ�̏���
	if($namelength != 0 && $commentlength != 0)
        {
//$name
$comment = $_POST["message"];
$order   = array("\r\n", "\n", "\r");
str_replace($order, "K1M1SH1M4", $comment);
//$comment = $comment."\r\n";
//var_dump($comment);
//exit;
            // ���O�̏�������
	    if (fwrite($fp,  $_POST["name"]. PHP_EOL) === FALSE)
            {
                // �������݂Ɏ��s�����ꍇ�̏���
		print('name NO');
                $CompleteFlag = false;
            }

	    // �{���̏�������
            //if (fwrite($fp,  $_POST["message"]) === FALSE)	//. PHP_EOL
            if (fwrite($fp,  $comment) === FALSE)	//. PHP_EOL
            {
                // �{���̏������݂Ɏ��s�����ꍇ�̏���
		print('message NO');
                $CompleteFlag = false;
            }

            // �t�@�C���̃A�����b�N
	    if(!flock($fp, LOCK_UN))
            {
                // �t�@�C���̃A�����b�N�Ɏ��s�����ꍇ�̏���
		print('fileLock NO');
                $CompleteFlag = false;
            }
        }
	
	// �������炪���͂���Ă��Ȃ��ꍇ�̏���
        else
        {
            echo("name or comment is NULL");
            $CompleteFlag = false;
        }
	
	// �t�@�C���N���[�Y
        $flag = fclose($fp);
	    
	// �t�@�C���N���[�Y�Ɏ��s�����ꍇ�̏���
	if (!$flag)
	{
	    print('close NO');
	    $CompleteFlag = false;
	}

	// �������s�����ɏ�����S�ďI�����ꍇ�̏���
	if($CompleteFlag)
	{
	    header( "Location: BBS.php" );
	    exit;
	}
    }
}
