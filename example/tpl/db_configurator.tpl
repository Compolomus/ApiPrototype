<?php

#echo '<pre>' . print_r($this, true) . '</pre>'; die;

?>
<form action="" method="post">
    <div><b>Конфигуратор базы данных</b></div>
    <div>Драйвер</div>
    <div><input type="text" name="driver" value="<?=$this->db_config['driver']?>" /></div>
    <div>Хост</div>
    <div><input type="text" name="host" value="<?=$this->db_config['host']?>" /></div>
    <div>Порт</div>
    <div><input type="text" name="port" value="<?=$this->db_config['port']?>" /></div>
    <div>Юзер</div>
    <div><input type="text" name="username" value="<?=$this->db_config['username']?>" /></div>
    <div>Пароль</div>
    <div><input type="text" name="password" value="<?=$this->db_config['password']?>" /></div>
    <div>Имя базы</div>
    <div><input type="text" name="dbname" value="<?=$this->db_config['dbname']?>" /></div>
    <div>Префикс</div>
    <div><input type="text" name="prefix" value="<?=$this->prefix?>" /></div>
    <div>Сравнение</div>
    <div><input type="text" name="collation" value="<?=$this->db_config['collation']?>" /></div>
    <div>Кодировка</div>
    <div><input type="text" name="charset" value="<?=$this->db_config['charset']?>" /></div>
    <div><input type="submit" name="submit" /></div>
</form>
