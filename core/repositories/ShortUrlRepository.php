<?php
declare(strict_types=1);

namespace app\core\repositories;

use app\core\entities\ShortUrl;

class ShortUrlRepository
{
    public function save(ShortUrl $shortUrl): void
    {
        if (!$shortUrl->save()) {
            throw new \RuntimeException('short url saving error');
        }
    }

    public function findById(int $id): ?ShortUrl
    {
        return ShortUrl::findOne($id);
    }

    public function findByUrl(string $url): ?ShortUrl
    {
        return ShortUrl::findOne(['url' => $url]);
    }

    public function findByHash(string $hash): ?ShortUrl
    {
        return ShortUrl::findOne(['hash' => $hash]);
    }
}