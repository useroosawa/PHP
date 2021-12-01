<?php
// dbx.php DBX�N���X �� �f�[�^�x�[�X�ڑ��Ǘ��N���X
class DBX {
	const DBHOST = "localhost";		//DB�z�X�g��
	const DBPORT = 3306;    		// DB�|�[�g�ԍ�
	const DBNAME = "lifeTime"; 		// �f�[�^�x�[�X��
	const DBCHAR = "utf8";    		//�N���C�A���g�����G���R�[�h
	const DBUSER = "root";    		// DB���[�U�[��
	const DBPASS = "root";    	//�p�X���[�h
	public static $pdo;				// PDO�I�u�W�F�N�g

	// connect() �� �f�[�^�x�[�X�ɐڑ�����
	public static function connect() {
		 self::$pdo = new PDO(
			"mysql:host=". self::DBHOST
          			.";port=".self::DBPORT
          			.";dbname=".self::DBNAME
           			.";charset=".self::DBCHAR,
			self::DBUSER, // ���[�U�[��
			self::DBPASS // �p�X���[�h
		);
		// �G���[�����O�ŏ�������
		self::$pdo->setAttribute(
			PDO::ATTR_ERRMODE,
			PDO::ERRMODE_EXCEPTION
		);
	}
}
?>
