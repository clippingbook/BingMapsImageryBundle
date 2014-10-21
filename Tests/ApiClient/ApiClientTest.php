<?php
/**
 * Created by 
 * User: karlos
 * Date: 19/03/14
 * Time: 19:27
 */
namespace Carlosromero\BingMapsImageryBundle\Tests\Api;

use Carlosromero\BingMapsImageryBundle\Api\ApiClient;
use Guzzle\Http\Client;
use Guzzle\Http\Message\Request;

class ApiClientTest extends \PHPUnit_Framework_TestCase
{
    protected $key = 'BingMapsKey';
    protected $mapType = 'AerialWithLabels';

    public function testConstruct()
    {
        $client = $this->getMockBuilder('\Guzzle\Http\Client')
                   ->disableOriginalConstructor()
                   ->getMock();
        $mApi = new ApiClient($client, $this->key, $this->mapType);
        $this->assertTrue($mApi instanceof ApiClient);
    }

    public function testQueryTerm()
    {
        $query = 'eiffel tower';
        $client = $this->_clientMock(
            "http://dev.virtualearth.net/REST/v1/Imagery/Map/$this->mapType/eiffel%20tower?key=$this->key&mapSize=300,200",
            null,
            '',
            ''//204 Ok, no malware urls
        );

        $mApi = new ApiClient($client, $this->key, $this->mapType);
        $result = $mApi->queryUrls($query, 300,200);
        $this->assertFalse($result);
    }

    private function _clientMock($url,$headers,$data,$body)
    {
        $response = $this->getMockBuilder('\Guzzle\Http\Message\Response')
            ->disableOriginalConstructor()
            ->getMock();
        $response->expects($this->once())
            ->method('getBody')
            ->will($this->returnValue($body));

        $request = $this->getMockBuilder('\Guzzle\Http\Message\Request')
            ->disableOriginalConstructor()
            ->getMock();
        $request->expects($this->once())
           ->method('send')
           ->will($this->returnValue($response));

        $client = $this->getMockBuilder('\Guzzle\Http\Client')
            ->disableOriginalConstructor()
            ->getMock();
        $client->expects($this->once())
                    ->method('post')
                    ->will($this->returnValue($request))
                    ->with(
                            $this->identicalTo($url),
                            $this->identicalTo($headers),
                            $this->identicalTo($data)
                    );
        return $client;
    }

}