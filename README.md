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
    public function index()
    {
        $source = '李彦宏是马云最大威胁嘛？';
        $pullWord = new PullWord($source);
        $result = $pullWord->get();
        // 结果 李彦 李彦宏 彦宏 马云 最大 大威 威胁
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
#### json返回
```php
$source = '李彦宏是马云最大威胁嘛？';
PullWord::source($source)->toJson()->get();
// 结果 [{"t":"李彦"},{"t":"李彦宏"},{"t":"彦宏"},{"t":"马云"},{"t":"最大"},{"t":"大威"},{"t":"威胁"}]
```
#### 调试模式
结果含有出词概率
```php
$source = '李彦宏是马云最大威胁嘛？';
PullWord::source($source)->debug()->get();
// 结果 李彦:0.23007 李彦宏:0.900302 彦宏:0.0703263 马云:1 最大:0.892363 大威:0.289136 威胁:0.9367
```

#### 设置阈值
出词概率阈值(0-1之间的小数)，1表示只有100%有把握的词才出
```php
$source = '李彦宏是马云最大威胁嘛？';
PullWord::source($source)->threshold(0.4)->get();
// 结果 李彦宏 马云 最大 威胁
```
