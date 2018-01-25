<?php

namespace Hungnguyenba\Apiconnectionservice;

use Hungnguyenba\Curl\Curl;

trait Helper
{
    protected $curl;

    protected function get(string $api, array $input = [], $isGetMetaData = false) : array
    {
        return $this->getCurl()->get($api, $this->isValid($input), $isGetMetaData);
    }

    protected function post(string $api, array $input = []) : array
    {
        return $this->getCurl()->post($api, $this->isValid($input));
    }

    protected function put(string $api, string $ids, array $input = []) : array
    {
        return $this->getCurl()->put($api, $ids, $this->isValid($input));
    }

    // protected function delete(string $api, int $id)
    // {
    //     $this->getCurl()->delete($api, $id);
    // }

    protected function getCurl()
    {
        if (empty($this->curl)) {
            $this->curl = new Curl($this->config['host']);
        }
        return $this->curl;
    }

    protected function initCurl(string $url)
    {
        unset($this->curl);
        $this->curl = new Curl($url);
        return $this;
    }

    protected function isValid(array &$input) : array
    {
        if (is_array(head($input))) {
            foreach ($input as $key => $record) {
                if (is_null($input[$key]['is_valid'] ?? null)) {
                    $input[$key]['is_valid'] = 1;
                }
            }
        } elseif (is_null($input['is_valid'] ?? null)) {
            $input['is_valid'] = 1;
        }
        return $input;
    }

    protected function setTag(string $tag)
    {
        $this->getCurl()->setTag($tag);
        return $this;
    }
}
