<?php
	$mongo = new MongoClient('localhost');
	$db = $mongo->test;
	$collectionNotes = $db->notes;
	$collectionUsers = $db->users;
	
	/*for ($i = 1; $i <= 10; $i++) //Добавление данных в базу даннх
	{
		$collectionNotes->insert(
			array(
				'dateCreate' => date('d.m.Y H:i:s'),
				'title' => 'Пример',
				'data' => 'Моя вторая записка',
				'user' => 'Example' . $i,
			)
		);
	}*/
	
	$cursorNotes = $collectionNotes->find();
	$textNodes = $cursorNotes->count() . ' document(s) found.' . PHP_EOL;
	foreach ($cursorNotes as $obj)
	{
		$textNodes .= 'Дата создания: ' . $obj['dateCreate'] . PHP_EOL;
		$textNodes .= 'Заголовок: ' . $obj['title'] . PHP_EOL;
		$textNodes .= 'Данные: ' . $obj['data'] . PHP_EOL;
		$textNodes .= 'Пользователь: ' . $obj['user'] . PHP_EOL;
		$textNodes .= PHP_EOL;
	}
	
	$cursorUsers = $collectionUsers->find();
	$textUsers = $cursorUsers->count() . ' document(s) found.' . PHP_EOL;
	foreach ($cursorUsers as $obj)
	{
		$textUsers .= 'E-mail: ' . $obj['e-mail'] . PHP_EOL;
		$textUsers .= 'Пароль: ' . $obj['password'] . PHP_EOL;
		$textUsers .= 'Имя: ' . $obj['name'] . PHP_EOL;
		$textUsers .= PHP_EOL;
	}
	
	$fileNameNodes = 'exportNodes.txt';
	$fileNodes = fopen($fileNameNodes, "w");
	fwrite($fileNodes, b"\xEF\xBB\xBF".$textNodes);
	fclose($fileNodes);
	
	$fileNameUsers = 'exportUsers.txt';
	$fileUsers = fopen($fileNameUsers, "w");
	fwrite($fileUsers, b"\xEF\xBB\xBF".$textUsers);
	fclose($fileUsers);
	
	echo '<html>';
	echo '<head>';
		echo '<title>Экспорт колекций базы даннх</title>';
		echo '<meta charset=\'utf-8\'>';
		echo '<style>';
			echo 'body{ margin: 0px; padding 0px; }';
			echo '.div50:hover{ border: 1px solid #434855; }';
		echo '</style>';
	echo '</head>';
	echo '<body>';
		echo '<div style=\'width: 1024px; margin: 0 auto; height: 700px;\'>';
			echo '<div align=\'center\' style=\'background-color: #434855; color: #fff; margin: 0px; padding-top: 10px; padding-bottom: 10px; font-size: 25px; width: 100%;\'>';
				echo 'Экспорт базы данных в текстовые файлы';
			echo '</div>';
			echo '<div class=\'div50\' style=\'width: 50%; heigth: 500px; float: left; font-size: 23px;\'>';
				echo '<a href=\'' . $fileNameUsers . '\' style=\'color: #fff; text-decoration: none;\'>';
					echo '<div align=\'center\' style=\'margin-left: 12%; width: 75%; margin-top: 20px; border: 4px solid #434855; background-color: #434855;\'>Users</div>';
					echo '<img src=\'users.png\' style=\'width: 100%\'></img>';
				echo '</a>';
			echo '</div>';
			echo '<div class=\'div50\' style=\'width: 49.8%; heigth: 500px; float: left; font-size: 23px;\'>';
				echo '<a href=\'' . $fileNameNodes . '\' style=\'color: #fff; text-decoration: none;\'>';
					echo '<div align=\'center\' style=\'margin-left: 12%; width: 75%; margin-top: 20px; border: 4px solid #434855; background-color: #434855;\'>Nodes</div>';
					echo '<img src=\'nodes.png\' style=\'width: 100%\'></img>';
				echo '</a>';
			echo '</div>';
		echo '</div>';
	echo '</body>';
	echo '<html/>';
	
?>