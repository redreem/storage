<?php

class StorageTemplate extends Core\Template
{

    /**
     * ������������ � ������ ���� �� ����������
     */
    public function before_render()
    {
        $this->assign('APPLICATION_DIR', '/application/storage');
    }

}