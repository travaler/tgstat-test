<?php

namespace app\controllers;

use app\core\repositories\ShortUrlRepository;
use app\core\services\ShortUrlService;
use app\forms\CreateShortUrlForm;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly ShortUrlRepository $shortUrlRepository,
        private readonly ShortUrlService $shortUrlService,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [

                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionShortUrl()
    {
        $form = new CreateShortUrlForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $shortUrl = $this->shortUrlService->create($form);

            return $this->redirect(['site/view-short-url', 'id' => $shortUrl->id]);
        }

        return $this->render('short-url', [
            'model' => $form,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionViewShortUrl(int $id)
    {
        $shortUrl = $this->shortUrlRepository->findById($id);

        if ($shortUrl === null) {
            throw new NotFoundHttpException('Short url not found');
        }

        return $this->render('view-short-url', [
            'url' =>  Url::to(['site/redirect-short-url', 'hash' => $shortUrl->hash], true),
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionRedirectShortUrl(string $hash)
    {
        $shortUrl = $this->shortUrlRepository->findByHash($hash);

        if ($shortUrl === null) {
            throw new NotFoundHttpException('Short url not found');
        }

        return $this->redirect($shortUrl->url);
    }
}
