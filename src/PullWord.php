<?php

namespace PullWord;

use GuzzleHttp\Client;
use PullWord\Exception\Exception;

class PullWord
{
    // 抽词内容
    private $source = '';

    // 调试模式 默认关闭
    private $debug = 0;

    // 出词概率阈值
    private $threshold = 0;

    // 是否json格式返回 默认返回文本
    private $json = 0;

    private $client;

    const URI = 'http://api.pullword.com';

    public function __construct($source = '')
    {
        if ($source) {
            $this->source = $source;
        }

        $this->client = new Client([
            'base_uri' => self::URI,
            'timeout'  => 10
        ]);
    }

    /**
     * 设置抽词内容
     *
     * @param [type] $source
     * @return void
     */
    public function source($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * 结果返回json格式
     *
     * @return void
     */
    public function toJson()
    {
        $this->json = 1;
        return $this;
    }

    /**
     * 开启阈值
     * 出词概率阈值(0-1之间的小数)，1表示只有100%有把握的词才出
     * @return void
     */
    public function threshold($value)
    {
        $this->threshold = floatval($value);
        return $this;
    }

    /**
     * 开启调试模式
     *
     * @return void
     */
    public function debug()
    {
        $this->debug = 1;
        return $this;
    }

    public function get()
    {
        if (!$this->source) {
            throw new Exception("Source Empty!");
        }

        $query = ['source' => $this->source, 'param1' => $this->threshold, 'param2' => $this->debug, 'json' => $this->json];

        try {
            $response = $this->client->get('/get.php', [
                'query' => http_build_query($query)
            ]);
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            throw new Exception('服务异常');
        }

        return $response->getBody()->getContents();
    }
}
