<?php

class StorageTemplate extends Core\Template
{

    /**
     * ѕробрасываем в шаблон путь до приложени€
     */
    public function before_render()
    {
        $this->assign('APPLICATION_DIR', '/application/storage');
    }

}