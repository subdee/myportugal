<?php

namespace frontend\components;

use SendGrid\Content;
use SendGrid\Email;
use SendGrid\Mail;
use SendGrid\Personalization;
use SendGrid\Response;
use Yii;
use yii\base\Component;
use yii\base\Exception;
use yii\base\ViewContextInterface;
use yii\web\View;

class SendGrid extends Component implements ViewContextInterface
{
    /** @var string */
    public $apiKey;

    /** @var string */
    public $viewPath = '@app/mail';

    /** @var null|string|array */
    public $from = null;

    /**
     * @var string HTML layout view name. This is the layout used to render HTML mail body.
     * The property can take the following values:
     *
     * - a relative view name: a view file relative to [[viewPath]], e.g., 'layouts/html'.
     * - a path alias: an absolute view file path specified as a path alias, e.g., '@app/mail/html'.
     * - a boolean false: the layout is disabled.
     */
    public $htmlLayout = 'layouts/html';

    /**
     * @var string text layout view name. This is the layout used to render TEXT mail body.
     * Please refer to [[htmlLayout]] for possible values that this property can take.
     */
    public $textLayout = 'layouts/text';

    /** @var Email[] */
    protected $recipients = [];

    /** @var Mail */
    protected $mailer;

    /** @var \SendGrid */
    protected $sendGrid;

    /**
     * @var \yii\base\View|array view instance or its array configuration.
     */
    private $view = [];

    public function init()
    {
        if (!$this->apiKey) {
            throw new \Exception('SendGrid API key must be configured');
        }
        $this->sendGrid = new \SendGrid($this->apiKey);
        $this->mailer = new Mail();
        if ($this->from) {
            $this->mailer->setFrom(new Email($this->from, $this->from));
        }
    }

    /**
     * @param $name
     * @param $email
     */
    public function setTo($name, $email)
    {
        $personalization = new Personalization();
        $personalization->addTo(new Email($name, $email));
        $this->mailer->addPersonalization($personalization);
    }

    /**
     * @param $view
     * @param array $params
     * @param string $template
     */
    public function setContent($view, $params = [], $template = '')
    {
        if (is_array($view)) {
            if (isset($view['html'])) {
                $content = new Content('text/html', $this->render($view['html'], $params, $this->htmlLayout));
                $this->mailer->addContent($content);
            }
            if (isset($view['text'])) {
                $content = new Content('text/plain', $this->render($view['text'], $params, $this->htmlLayout));
                $this->mailer->addContent($content);
            }
        } else {
            $content = new Content('text/html', $this->render($view, $params, $this->htmlLayout));
            $this->mailer->addContent($content);
        }
        if ($template !== '') {
            $this->mailer->setTemplateId($template);
        }
    }

    /**
     * @param $subject
     */
    public function setSubject($subject)
    {
        $this->mailer->setSubject($subject);
    }

    /**
     * @throws Exception
     */
    public function send()
    {
        /** @var Response $response */
        $response = $this->sendGrid->client->mail()->send()->post($this->mailer);
        if ($response->statusCode() > 399) {
            throw new Exception($response->body());
        }
    }

    /**
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $listId
     * @throws Exception
     * @return void
     */
    public function addRecipientToList($firstName, $lastName, $email, $listId)
    {
        $query = (object)[
            'email' => $email
        ];
        /** @var Response $response */
        $response = $this->sendGrid->client->contactdb()->recipients()->search()->get(null, $query);
        if ($response->statusCode() == 400) {
            throw new Exception($response->body());
        }
        $recipient = json_decode($response->body())->recipients[0];
        if ($recipient) {
            $recipientId = $recipient->id;
        } else {
            $request = (object)[
                'email' => $email,
                'first_name' => $firstName,
                'last_name' => $lastName
            ];

            /** @var Response $response */
            $response = $this->sendGrid->client->contactdb()->recipients()->post([$request]);
            if ($response->statusCode() > 399) {
                throw new Exception($response->body());
            }

            $recipientId = json_decode($response->body())->persisted_recipients[0];
        }

        /** @var Response $response */
        $response = $this->sendGrid->client->contactdb()->lists()->_($listId)->recipients()->_($recipientId)->post();
        if ($response->statusCode() > 399) {
            throw new Exception($response->body());
        }

        return;
    }

    /**
     * @return string the view path that may be prefixed to a relative view name.
     */
    public function getViewPath()
    {
        return $this->viewPath;
    }

    /**
     * Renders the specified view with optional parameters and layout.
     * The view will be rendered using the [[view]] component.
     * @param string $view the view name or the path alias of the view file.
     * @param array $params the parameters (name-value pairs) that will be extracted and made available in the view file.
     * @param string $layout layout view name or path alias. If false, no layout will be applied.
     * @return string the rendering result.
     */
    public function render($view, $params = [], $layout = '')
    {
        $output = $this->getView()->render($view, $params, $this);
        if ($layout !== '') {
            return $this->getView()->render($layout, ['content' => $output], $this);
        } else {
            return $output;
        }
    }

    /**
     * @return View view instance.
     */
    public function getView()
    {
        if (!is_object($this->view)) {
            $this->view = $this->createView($this->view);
        }

        return $this->view;
    }

    /**
     * Creates view instance from given configuration.
     * @param array $config view configuration.
     * @return View view instance.
     */
    protected function createView(array $config)
    {
        if (!array_key_exists('class', $config)) {
            $config['class'] = View::className();
        }

        return Yii::createObject($config);
    }
}