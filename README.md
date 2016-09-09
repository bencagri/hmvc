# HMVC Framework Sample

This is a sample application. Dont use in production.

## v2.0 Changelog

* HMVC modular system is implemented
* Any library,helper,model and config can be used separately inside any module.
* Loader class has been separated.
* Loader(), Config(), Template() classes have been added to core.
* system directory structure has been changed
* Routing feature has been added. With configuration, can be used with both modules and standalone controllers. (See app/config/route.php)
* Controllers are now extendable (see app/core directory)
* Repository Design Pattern has been implemented. Now, with Drivers, it is much more convenient.

I believe this is much more efficient. I considered Rest_server as thirdparty library.

## Requirements

* PHP 5.4 or greater
* The mod_rewrite Apache module

## Installation

* Download Repo and extract
* Navigate to `app/config/config.php` and fill in your `base_url`
* You are ready! Point your browser to your `base_url` and hopefully see homepage.


# RULES

There are some rules to use framework. Here are some examples of using system partials in our application.

### Config

* ```$config``` is a global variable.
* You can create new config files to use in your project.
* Your config key **must be same** with your config file.

Example for app/config/foo.php
```
$config['foo']['bar'] = 'bar';
$config['foo']['baz'] = [1,2,3];
```

You can load any config files in your app. Sample;
```
    $myconfig = new Config('foo');
    $foo = $myconfig::get();

```
To load a config inside a module;
```
    $myconfig = new Config('mymodule/foo');
    $foo = $myconfig::get();
```

### Loader

* Models - To use models inside modules
```
Loader::model('trycatch/my_model'); // in trycatch module
Loader::model('sample'); //in app/models directory
```

* Library - We can easily integrate 3rd party libraries into our app
```
Loader::library('routed/sample'); //in routed module
Loader::library('facebook_sdk'); //in app/libraries directory
```


* Helpers - To include useful functions
```
Loader::helper('type_control'); //in app/libraries directory
```

### Template

```
Template::view('index',['foo' => 'bar','baz'=> 'foo']); //loads app/view/index with variables
```
