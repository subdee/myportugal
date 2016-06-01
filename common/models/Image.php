<?php

namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

class Image extends Model
{
    public $filename;
    public $type;
    public $content;

    public function attributes()
    {
        return [
            'filename',
            'type',
            'content'
        ];
    }

    public function create(UploadedFile $file)
    {
        if ($file) {
            $this->filename = $file->name;
            $this->type = $file->type;
            $this->content = base64_encode(file_get_contents($file->tempName));
        }

        return true;
    }
}