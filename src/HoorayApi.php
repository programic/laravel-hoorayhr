<?php

namespace Programic\Hooray;

use GuzzleHttp\Client;
use Programic\Hooray\Exceptions\HoorayException;

class HoorayApi
{
    protected Client $client;
    protected $accessToken;
    protected $user;

    private $username;
    private $password;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.hooray.nl/',
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    /**
     * @throws HoorayException
     */
    public function authenticate(): void
    {
        $data = [
            'strategy' => 'local',
            'email' => $this->getUsername(),
            'password' => $this->getPassword(),
        ];

        try {
            $response = $this->client->post('authentication', ['form_params' => $data])->getBody()->getContents();
            $response = json_decode($response, true);

            $this->accessToken = $response['accessToken'];
            $this->user = $response['user'];
        } catch(\Throwable $exception) {
            throw new HoorayException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @param string|array $query
     * @return array
     * @throws HoorayException
     */
    public function getTeams($query = null): array
    {
        return $this->call('teams', $query);

    }

    /**
     * @param string|array $query
     * @return array
     * @throws HoorayException
     */
    public function getUsers($query = null): array
    {
        return $this->call('users', $query);

    }

    /**
     * @param string|array $query
     * @return array
     * @throws HoorayException
     */
    public function getUpcoming($query = null): array
    {
        return $this->call('upcoming', $query);
    }

    /**
     * @param string|array $query
     * @return array
     * @throws HoorayException
     */
    public function getCalendars($query = null): array
    {
        return $this->call('calendars', $query);
    }

    /**
     * @param string $uri
     * @param string|array $query
     * @return array
     * @throws HoorayException
     */
    private function call(string $uri, $query = null): array
    {
        if (is_null($this->accessToken)) {
            $this->authenticate();
        }

        if (is_array($query)) {
            $query = http_build_query($query);
        }

        if ($query) {
            $uri = $uri  . '?' . $query;
        }

        try {
            $options = [
                'headers' => ['Authorization' => $this->accessToken],
            ];
            $response = ($this->client->get($uri, $options))->getBody()->getContents();

            return json_decode($response, true);
        } catch(\Throwable $exception) {
            throw new HoorayException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @return mixed
     */
    private function getUsername()
    {
        return $this->username ?? config('services.hooray.username');
    }

    /**
     * @return mixed
     */
    private function getPassword()
    {
        return $this->password ?? config('services.hooray.password');
    }

    /**
     * @return mixed
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }
}
