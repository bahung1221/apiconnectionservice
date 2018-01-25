<?php

namespace Hungnguyenba\Apiconnectionservice;

use Hungnguyenba\Apiconnectionservice\Helper;

trait Service
{
    use Helper;

    protected $model;

    protected $isPaging = false;
    protected $page = 0;
    protected $lastPage = 0;

    public function setPaging(bool $val)
    {
        $this->isPaging = $val;
        return $this;
    }

    protected function paging(array $data, int $firstPage, int $lastPage) : array
    {
        return $this->isPaging
            ? Utils::calculatePaging(array_null_filter($data), $firstPage, $lastPage)
            : array_null_filter($data);
    }

    public function setModel(string $model)
    {
        $this->model = $model;
        return $this;
    }

    public function getModel()
    {
        return class_exists($this->model) ? new $this->model : null;
    }

    public function setCurl(string $url)
    {
        return $this->initCurl($url);
    }
}
