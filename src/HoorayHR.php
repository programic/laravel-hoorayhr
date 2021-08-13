<?php

namespace Programic\Hooray;

use Illuminate\Contracts\Foundation\Application;

/**
 * Class HoorayHR
 * @package Programic\Hooray
 * @extends Programic\Hooray\HooraiApi
 */
class HoorayHR
{
    protected $app;
    protected $client;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->client = new HoorayApi();
    }

    public function setCredentials($username, $password)
    {
        $this->client->setUsername($username);
        $this->client->setPassword($password);
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->client, $name))
        {
            return $this->client->$name(...$arguments);
        }

        throw new \BadMethodCallException($name . ' not defined');
    }
}
