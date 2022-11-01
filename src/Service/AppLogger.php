<?php

namespace App\Service;

use think\facade\Log;

class AppLogger
{
    const TYPE_LOG4PHP = 'log4php';
    const TYPE_THINK = 'think-log';

    private $logger;

    /*
     * 适配器
     *
     * //定义接口
      interface CustomLog
      {
        function info();
        function debug();
        function error();
      }
     //实现接口
      class log$php implements Log{
          public function info();
          。。。
      }
      class thinkLog implements Log{}

      class AppLogger
      {
         //依赖注入,具体用哪种日志 交给外部决定
         public function __construct(CustomLog $logger){
             $this->logger = $logger;
         }
       }
       $appLogger = new AppLogger(new thinkLog());
      */

    public function __construct($type = self::TYPE_LOG4PHP)
    {
        /**
         * 工厂模式 ，内部实力化
         */
        if ($type == self::TYPE_LOG4PHP) {
            $this->logger = \Logger::getLogger("Log");
        } elseif ($type == self::TYPE_THINK) {
           // $this->logger = new Log();

        }
    }

    public function info($message = '')
    {
        //内容转大写可以判断 ，或者在外部调用的时候已经转换完毕
        // if($this->logger instanceof 'think-log'){
        //    $message = strtoupper($message)  ;
        //}

        $this->logger->info($message);
    }

    public function debug($message = '')
    {
        $this->logger->debug($message);
    }

    public function error($message = '')
    {
        $this->logger->error($message);
    }
}