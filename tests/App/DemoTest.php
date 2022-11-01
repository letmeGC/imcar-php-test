<?php

namespace Test\App;

use App\App\Demo;
use App\Service\AppLogger;
use App\Util\HttpRequest;
use PHPUnit\Framework\TestCase;


class DemoTest extends TestCase
{
    private $demoClass;

    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $logger = new AppLogger('log4php');
        $httpClient = new HttpRequest();
        $this->demoClass = new Demo($logger, $httpClient);
    }

    public function test_foo()
    {

        $this->assertEquals("bar", $this->demoClass->foo());
    }

    public function test_get_user_info()
    {
        $res = $this->demoClass->get_user_info();
        $this->assertEquals($res,['id'=>1,'username'=>'hello world']);
    }
}
