<?php
/**
 * Created by 
 * User: info@carlosromero.eu
 * Date: 19/03/14
 * Time: 19:25
 */

namespace Carlosromero\BingMapsImageryBundle\Api;

use Guzzle\Http\Client;

class ApiClient {

    /**
     * @var \Guzzle\Service\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
     protected $mapType;

    /**
     * @var string
     */
    protected $baseUrl = 'http://dev.virtualearth.net/REST/V1/Imagery/Map/%MAP_TYPE%/%QUERY%?key=%APIKEY%&mapSize=%WIDTH%,%HEIGHT%';

    function __construct(Client $client, $key, $mapType, $baseUrl= '')
    {
        $this->client = $client;
        $this->key = $key;
        $this->mapType = $mapType;
        if (!empty($baseUrl)) {
            $this->baseUrl = $baseUrl;
        }
    }

    /**
     *
     * Get a map imagery based on a query term.
     * @param $query
     * @return array|bool
     */
    function query($query, $width = 500, $height =400, $options =  array())
    {
        $query = rawurlencode($query);
        $url = str_replace(array('%APIKEY%', '%MAP_TYPE%', '%QUERY%','%WIDTH%', '%HEIGHT%'), array($this->key, $this->mapType, $query, $width, $height), $this->baseUrl);
        foreach ($options as $option => $value) {
            $url .= "&$option=$value";
        }
        $request = $this->client->post($url);
        try {
            $response = $request->send();
        } catch (\Exception $e) {
            return false;
        }
        $bodyResponse = $response->getBody(true);
        return ($response->getStatusCode() != 200)? false :  $bodyResponse;
    }

}