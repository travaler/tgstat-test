<?php
namespace app\core\entities;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $url
 * @property string $hash
 */
class ShortUrl extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'short_urls';
    }

    public static function create(string $url, string $hash): self
    {
        $shortUrl = new self();
        $shortUrl->url = $url;
        $shortUrl->hash = $hash;

        return $shortUrl;
    }
}