<?php
/**
 * Created by PhpStorm.
 * User: jomon
 * Date: 2/12/18
 * Time: 11:11 PM
 */

namespace codexten\hosts;

use yii\base\Component;

class Hosts extends Component
{
    public $hostsFile;

    public function add($hostName, $ip = '127.0.0.1')
    {
        if ($this->exist($hostName)) {
            return true;
        }

        return $this->putContent("{$ip} {$hostName}");
    }

    protected function exist($hostName)
    {
        return !(strpos($this->getContent(), $hostName) === false);
    }

    protected function getContent()
    {
        return file_get_contents($this->hostsFile);
    }

    protected function putContent($string)
    {
        $data = $this->getContent() . PHP_EOL . $string;

        return file_put_contents($this->hostsFile, $data);
    }
}