## 什么是Twreg？ ##

Twreg是一个twitter注册程序。(观摩一下：http://twreg.info)

作为用户，它可以使您方便、快捷的注册twitter帐号，尤其在您不便访问twitter网站的时候。

作为服务提供商，它可以使您的网站集成twitter注册功能，增加您网站的亲近度。


---


## Twreg的结构？ ##

Twreg总共由两部分组成，一部分负责和twitter通信（API部分，并非官方API，模拟注册程序），一部分负责注册操作。负责和twitter通信的部分提供一个API接口，注册操作部分的程序通过这个API接口实现注册。

![http://i29.photobucket.com/albums/c289/gowers/11-1.jpg](http://i29.photobucket.com/albums/c289/gowers/11-1.jpg)

你可以将这两部分可以分开安装。


---


## Twreg安装环境？ ##

1、需要php运行环境，至少为php 5；

2、需要CURL组件支持；

3、支持Sina App Engine的php环境（请下载Twreg\_compatible\_with\_SAE.rar包）


---


## 如何安装？ ##

### 一、整体安装(适合在海外有服务器或网站空间的用户) ###

1、下载Twreg程序，您可以通过SVN下载，或者下载我们提供的.zip文件.

2、修改config.php
```
     define('API_URL', 'http://Twreg.info/api/'); 
```
> 将http://Twreg.info/api/ 修改成“http://yourdomain /Twreg安装目录/api/”

3、将修改后的程序上传至您的空间，然后您就可以通过访问http://yourdomain /Twreg安装目录 来体验Twreg了。

### 二、仅架设注册程序（适合在墙内的且在国外没有服务器空间的，但还想提供twitter注册程序的） ###

1、下载Twreg程序，您可以通过SVN下载，或者下载我们提供的.zip文件，解压后删除api目录。

2、修改config.php
```
     define('API_URL', 'http://Twreg.info/api/'); 
```
> 将http://Twreg.info/api/  修改成他人提供的基于Twreg架设的API接口。

3、将修改后的程序上传至您的空间，然后您就可以正常使用Twreg了。

### 三、仅架设API部分（务必是墙外服务器） ###

1、下载Twreg程序，您可以通过SVN下载，或者下载我们提供的.zip文件.

2、将其中的api目录中的内容上传到您的服务器即可

### 四、在Sina App Engine (SAE)上架设注册程序 ###

1、下载Twreg程序，您可以通过SVN下载，或者下载我们提供的Twreg\_compatible\_with\_SAE.rar文件

2、修改config.php
```
     define('API_URL', 'http://Twreg.info/api/'); 
```
> 将http://Twreg.info/api/  修改成他人提供的基于Twreg架设的API接口。

```
     define('IS_ON_SAE', '');
```
> 修改成  define('IS\_ON\_SAE', 'yes');

```
     define('AKEY', '');   define('SKEY', '');
```
> 两者对应的输入SAE的Access Key和Security Key

3、用SAE开发包上传程序即可。