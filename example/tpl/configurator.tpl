<form action="" method="post">
    <div><b>Конфигуратор</b></div>
    <div>Префикс</div>
    <div><input type="text" name="prefix" value="<?=$this->config['prefix']?>" /></div>
    <div><input type="text" name="db_driver" value="<?=$this->config['db_driver']?>" /></div>
    <div><input type="text" name="response" value="<?=$this->config['response']?>" /></div>
    <div>Комменты <input type="checkbox" name="comments" <?=!$this->config['comments'] ?: 'checked'?> /></div>
    <div>Лайки <input type="checkbox" name="like" <?=!$this->config['like'] ?: 'checked'?> /></div>
    <div>Приекрепление файлов <input type="checkbox" name="attach" <?=!$this->config['attach'] ?: 'checked'?> /></div>
    <div>Тэги <input type="checkbox" name="tag" <?=!$this->config['tag'] ?: 'checked'?> /></div>
    <div><input type="submit" name="submit" /></div>
</form>

