<?php

/**
 * ExportService.php
 *
 * @copyright 2022 wkld.com - All Rights Reserved
 * @link https://www.wkld.com
 * @author stiffer.chen <2181867045@qq.com>
 * @created 2022-04-08 18:17:21
 * @modified 2022-04-08 18:17:21
 */

namespace App\Services;

class ExportService
{
    private $data = [];
    private $fileName = '';

    public function __construct(array $data, string $fileName)
    {
        $this->data = $data;
        $this->fileName = $fileName;
    }

    /**
     * 导出JSON文件
     * @return void
     */
    public function toJson()
    {
        // 格式化输出+中文不转码
        $json = json_encode($this->data, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        $name = $this->fileName . time();
        header("Content-disposition: attachment; filename={$name}.json");
        header('Content-type: application/json');
        echo $json;
    }
}