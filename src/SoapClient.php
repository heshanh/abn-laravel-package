<?php

namespace heshanh\Abn;

class SoapClient
{
    private $guid;
    private $serviceUrl;
    private $client;


    /**
     * SoapClient constructor.
     * @param $client
     * @param $token
     */
    public function __construct($serviceUrl, $guid)
    {
        $this->setGuid($guid);
        $this->setUrl($serviceUrl);

        $this->client = new \SoapClient($this->getUrl());

        return $this;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return $this->client->__getFunctions();
    }


    /**
     * @return \SoapClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->serviceUrl = $url;
        return $this;
    }

    /**
     * @param $key
     * @return $this
     */
    public function setGuid($key)
    {
        $this->guid = $key;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->serviceUrl;
    }

    /**
     * @param array $args
     * @return array
     */
    function getParams($args = [])
    {
        $vars = new \stdClass();
        $vars->authenticationGuid = $this->getGuid();

        foreach ($args as $k => $v) {
            $vars->$k = $v;
        }

        return $vars;
    }

    /**
     * @param $abn
     * @param array $params
     * @param string $service
     * @return mixed
     * @throws \Exception
     */
    public function search($abn, $params = [], $service = 'ABRSearchByABN')
    {
        try {

            $soap_params = ['searchString' => $this->remove_all_but_numbers($abn)];
            $soap_params = array_merge($soap_params, $params);

            return $this->client->{$service}($this->getParams($soap_params));
        } catch (\Exception $e) {
            throw new \Exception((string)$e->getMessage());

        }
    }

    private function remove_all_but_numbers($string)
    {
        return preg_replace("/[^0-9]/", "", $string);
    }

}