<?php
namespace app\core\services;

use app\core\entities\ShortUrl;
use app\core\repositories\ShortUrlRepository;
use app\forms\CreateShortUrlForm;
use yii\base\Security;

class ShortUrlService
{
    public function __construct(
        private readonly ShortUrlRepository $shortUrlRepository,
        private readonly Security $security,
    ) {

    }

    public function create(CreateShortUrlForm $form): ShortUrl
    {
        $shortUrl = $this->shortUrlRepository->findByUrl($form->url);

        if ($shortUrl !== null) {
            return $shortUrl;
        }

        $hash = $this->security->generateRandomString(5);
        $shortUrl = ShortUrl::create($form->url, $hash);
        $this->shortUrlRepository->save($shortUrl);

        return $shortUrl;
    }
}