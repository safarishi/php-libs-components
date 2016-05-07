<?php

class CustomLog
{
    const LOG_LEVEL_ERROR = 1;
    const LOG_LEVEL_WARNING = 2;
    const LOG_LEVEL_NOTICE = 3;
    const LOG_FILE = 'php_log_%s.log';

    private $msg = '';

    public function __construct() {}

    public function __destruct()
    {
        if ($this->msg !== '') {
            $file = sprintf(self::LOG_FILE, date('Ymd'));
            file_put_contents($file, $this->msg, FILE_APPEND);
        }
    }

    private function log($msg, $level)
    {
        switch ($level) {
            case self::LOG_LEVEL_NOTICE:
                $this->msg .= '['.date('Y-m-d H:i:s').'] Notice: '.$msg."\n";
                break;
            case self::LOG_LEVEL_WARNING:
                $this->msg .= '['.date('Y-m-d H:i:s').'] Warning: '.$msg."\n";
                break;
            case self::LOG_LEVEL_ERROR:
                $this->msg .= '['.date('Y-m-d H:i:s').'] Error: '.$msg."\n";
                break;
        }
    }

    public function notice($msg)
    {
        $this->log($msg, self::LOG_LEVEL_NOTICE);
    }

    public function warning($msg)
    {
        $this->log($msg, self::LOG_LEVEL_WARNING);
    }

    public function error($msg)
    {
        $this->log($msg, self::LOG_LEVEL_ERROR);
    }
}
