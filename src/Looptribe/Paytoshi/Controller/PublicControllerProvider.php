<?php

namespace Looptribe\Paytoshi\Controller;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;

class PublicControllerProvider implements ControllerProviderInterface
{
    private $before;

    public function __construct($before)
    {
        $this->before = $before;
    }

    /**
     * @inheritdoc
     */
    public function connect(Application $app)
    {
        /** @var ControllerCollection $controllers */
        $controllers = $app['controllers_factory'];

        $controllers->get('/', 'controller.index:action')->bind('homepage');
        $controllers->get('/faq', 'controller.faq:action')->bind('faq');
        $controllers->post('/reward', 'controller.reward:action')->bind('reward');

        $controllers->before($this->before);

        return $controllers;
    }
}
