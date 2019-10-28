# think-pullword
ThinkPHP 分词/抽词 扩展包 `5.1` `6.0`

[![Latest Stable Version](https://poser.pugx.org/xiaodi/think-pullword/version)](https://packagist.org/packages/xiaodi/think-pullword)
[![License](https://poser.pugx.org/xiaodi/think-pullword/license)](https://packagist.org/packages/xiaodi/think-pullword)
## 安装
```
composer require xiaodi/think-pullword:dev-master
```

## 使用
#### 常规实例化
```php
use PullWord\PullWord;
class Index
{
    public function index( $pullWord)
    {
        $source = '李彦宏是马云最大威胁嘛？';
        $pullWord = new PullWord($source);
        $result = $pullWord->get();
        var_dump($result);
    }
}
```

#### 依赖注入
```php
use PullWord\PullWord;
class Index
{
    public function index(PullWord $pullWord)
    {
        $source = '李彦宏是马云最大威胁嘛？';
        $result = $pullWord->source($source)->get();
        var_dump($result);
    }
}
```

#### 门面
```php
use PullWord\Facade\PullWord;

class Index
{
    public function index()
    {
        $source = '李彦宏是马云最大威胁嘛？';
        $result = PullWord::source($source)->get();
        var_dump($result);
    }
}
```

#### 助手函数
```php
class Index
{
    public function index()
    {
        $source = '李彦宏是马云最大威胁嘛？';
        $result = app('pullword')->source($source)->get();
        var_dump($result);
    }
}

```

## 其它链式方法
#### 返回json格式
```php
PullWord::source($source)->toJson()->get()
```
#### 开启调试模式
含有出词概率
```php
PullWord::source($source)->debug()->get()
```

#### 开启阈值
出词概率阈值(0-1之间的小数)，1表示只有100%有把握的词才出
```php
PullWord::source($source)->threshold(0.5)->get()
```
