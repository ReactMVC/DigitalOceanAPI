<?php

/*
DigitalOcean Api

A PHP library for interacting with DigitalOcean API
*/

namespace DigitalOcean;

// Import the required classes
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

// class Api
class Api
{
    private $client;
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
        $this->client = new Client([
            'base_uri' => 'https://api.digitalocean.com/v2/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    /**
     * Create a new droplet
     *
     * @param string $name
     * @param string $region
     * @param string $size
     * @param int $imageId
     * @return array
     */
    public function createDroplet($name, $region, $size, $imageId)
    {
        $response = $this->client->post('droplets', [
            'json' => [
                'name' => $name,
                'region' => $region,
                'size' => $size,
                'image' => $imageId
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Get information about a droplet
     *
     * @param int $id
     * @return array
     */
    public function getDroplet($id)
    {
        $response = $this->client->get("droplets/{$id}");

        return json_decode($response->getBody(), true);
    }

    /**
     * Delete a droplet
     *
     * @param int $id
     * @return void
     */
    public function deleteDroplet($id)
    {
        $this->client->delete("droplets/{$id}");
    }

    /**
     * Rename a droplet
     *
     * @param int $id
     * @param string $name
     * @return array
     */
    public function renameDroplet($id, $name)
    {
        $response = $this->client->post("droplets/{$id}/actions", [
            'json' => [
                'type' => 'rename',
                'name' => $name
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Reboot a droplet
     *
     * @param int $id
     * @return array
     */
    public function rebootDroplet($id)
    {
        $response = $this->client->post("droplets/{$id}/actions", [
            'json' => [
                'type' => 'reboot'
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Resize a droplet
     *
     * @param int $id
     * @param string $size
     * @return array
     */
    public function resizeDroplet($id, $size)
    {
        $response = $this->client->post("droplets/{$id}/actions", [
            'json' => [
                'type' => 'resize',
                'size' => $size
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}
?>