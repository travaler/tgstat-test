<?php
namespace app\forms;

use yii\base\Model;

class CreateShortUrlForm extends Model
{
    /** @var string */
    public $url;

    public function rules(): array
    {
        return [
            ['url', 'string', 'max' => 255],
            ['url', 'url'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'url' => 'Ссылка для сокращения',
        ];
    }
}