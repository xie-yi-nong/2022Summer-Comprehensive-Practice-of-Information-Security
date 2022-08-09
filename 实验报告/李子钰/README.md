# DOCKER封装

## 实验目的

把环境打包

## 实验环境

Ubuntu22.04、vscode、docker

## 实验过程

#### 前置准备

1.` php`环境搭建(参考自赵雨萌的实验报告)

- 下载并安装`xampp`

<img src=".\img\01.png" style="zoom:50%;" />

<img src=".\img\02.png" style="zoom:50%;" />

将`xampp`文件夹中`PHP.exe`所在文件夹路径添加进环境变量-系统变量-`Path`

<img src=".\img\03.png" style="zoom:50%;" />

在`cmd`中输入`php -v`，检查是否配置成功

<img src=".\img\04.png" style="zoom:50%;" />

打开vscode并安装相关拓展（还有两个拓展不在一起，遂没截）

<img src=".\img\06.png"  />

点击 VSCode 的`文件-首选项-设置`，在设置的扩展中找到 PHP ，点击`setting.json`添加以下配置

<img src=".\img\07.png"  />

2.配置phpmyadmin

下载`phpmyadmin`并解压至`xampp`文件夹中

将`config.sample.inc.php`，改名为`config.inc.php`

<img src=".\img\08.png"  />

并且对文件进行修改

<img src=".\img\09.png"  />

打开`xampp`链接`apache`和`mysql`之后打开`phpmyadmin`

3.连接数据库`login_db`，与注册及登录界面相连

创建`user`表，包含4列。4列分别为：`id（primary key），name，Email（unique），password_hash`

<img src=".\img\13.png"  />

### 打包部分

#### docker安装

###### 1.上官网并下载docker 桌面版，并且检查本机系统是否启用的设置-应用和功能-可选功能-更多windows功能-“适用于Linux的windows子系统”选项

<img src=".\img\14.png" style="zoom:67%;" />

安装成功

###### 2.启用wsl2功能

先为linux启用Windows子系统

```
dism.exe /online /enable-feature /featurename:Microsoft-Windows-Subsystem-Linux /all /norestart
```

安装 WSL 2 之前，必须启用“虚拟机平台”可选功能

```
dism.exe /online /enable-feature /featurename:VirtualMachinePlatform /all /norestart
```

<img src=".\img\15.png" style="zoom: 80%;" />

启动系统后，最好在检查一下虚拟机是否以启动。通过以下方式进行检查，

打开 `控制面版`，查看方式可选择`大图标`，在点击`程序与功能`—>`启用或关闭Windows功能`，检查下图中红框圈出内容是否均以打对勾；若没有，则需要打对勾并点击确定。

<img src=".\img\16.png" style="zoom: 80%;" />

另外，在检查一下`任务管理器`中-`性能`-CPU中的`虚拟化`是否已开启

<img src=".\img\17.png" style="zoom: 80%;" />

下载内核更新包并运行

设置分发版本，打开powershell运行命令进行版本的更新

```
 `wsl --set-version Ubuntu-22.04 2`
```

<img src=".\img\18.png" style="zoom: 80%;" />

查询版本之后发现wsl已更新为wsl2版本

<img src=".\img\19.png" style="zoom: 80%;" />

将ubuntu转为wsl2之后，在docker设置中将Ubuntu结合

<img src=".\img\20.png" style="zoom: 80%;" />

运行第一个镜像hello world

<img src=".\img\21.png" style="zoom: 80%;" />

###### 3.编写项目Dockerfile

1. 了解之前写网页的文件所用到的版本为php8
2. 定义nginx文件
3. supervisor: 用于启动并守护php-fpm,nginx进程

![image-20220808011435710](.\img\27.png)


###### 4.编写docker-compose

![image-20220808011654550](.\img\28.png)

###### 5.启动检查是否成功

```
docker-compose up -d 
```

![image-20220808012202937](.\img\29.png)

![image-20220808012235501](.\img\30.png)

###### 6.启动完毕后检查是否能够运行成功

![image-20220808012317421](.\img\31.png)

###### 遇到的问题

1.环境变量配置不成功，按照同样的方法来做，但是显示

<img src=".\img\05.png" style="zoom: 80%;" />

解决方法：重启电脑，自己就好了，原理未知。

2.打开了apache和mysql但是打开网页显示

<img src=".\img\10.png" style="zoom: 80%;" />

<img src=".\img\11.png" style="zoom: 33%;" />

讲apache和mysql所有端口从3306修改为3316之后即可。

3.刚开始做docker的时候拉错了镜像，安装了aconona3的环境（截图可以在img中查询)

参考：

[docker安装](https://blog.csdn.net/yikuaigege/article/details/124019013)

[wsl2启用](https://www.jianshu.com/p/0aa542003b93)

[wsl2升级](https://blog.csdn.net/weixin_56578402/article/details/121540397?spm=1001.2101.3001.6661.1&utm_medium=distribute.pc_relevant_t0.none-task-blog-2%7Edefault%7ECTRLIST%7Edefault-1-121540397-blog-109564009.pc_relevant_multi_platform_whitelistv3&depth_1-utm_source=distribute.pc_relevant_t0.none-task-blog-2%7Edefault%7ECTRLIST%7Edefault-1-121540397-blog-109564009.pc_relevant_multi_platform_whitelistv3&utm_relevant_index=1)

[docker使用](https://blog.csdn.net/qq_32101863/article/details/120344080#t12)

[docker~php](https://blog.csdn.net/weixin_42674576/article/details/121180526)

[dockerfile](https://blog.csdn.net/u010336468/article/details/124108069)

[docker](https://blog.csdn.net/a516972602/article/details/86376990?spm=1001.2101.3001.6661.1&utm_medium=distribute.pc_relevant_t0.none-task-blog-2%7Edefault%7EBlogCommendFromBaidu%7Edefault-1-86376990-blog-124108069.pc_relevant_vip_default&depth_1-utm_source=distribute.pc_relevant_t0.none-task-blog-2%7Edefault%7EBlogCommendFromBaidu%7Edefault-1-86376990-blog-124108069.pc_relevant_vip_default&utm_relevant_index=1)

[docker](https://www.jb51.net/article/254954.htm)

[dockerfile](https://blog.csdn.net/m0_46090675/article/details/121846718?ops_request_misc=%257B%2522request%255Fid%2522%253A%2522165997500116782350867007%2522%252C%2522scm%2522%253A%252220140713.130102334..%2522%257D&request_id=165997500116782350867007&biz_id=0&utm_medium=distribute.pc_search_result.none-task-blog-2~all~top_positive~default-1-121846718-null-null.142^v39^pc_rank_v38,185^v2^control&utm_term=dockerfile&spm=1018.2226.3001.4187)

[dockerfile](https://blog.csdn.net/weixin_45932821/article/details/113760946?ops_request_misc=%257B%2522request%255Fid%2522%253A%2522165997500116782350867007%2522%252C%2522scm%2522%253A%252220140713.130102334..%2522%257D&request_id=165997500116782350867007&biz_id=0&utm_medium=distribute.pc_search_result.none-task-blog-2~all~top_positive~default-2-113760946-null-null.142^v39^pc_rank_v38,185^v2^control&utm_term=dockerfile&spm=1018.2226.3001.4187)

[docker-compose](https://blog.csdn.net/pushiqiang/article/details/78682323?ops_request_misc=%257B%2522request%255Fid%2522%253A%2522165997515816782248555916%2522%252C%2522scm%2522%253A%252220140713.130102334..%2522%257D&request_id=165997515816782248555916&biz_id=0&utm_medium=distribute.pc_search_result.none-task-blog-2~all~top_positive~default-1-78682323-null-null.142^v39^pc_rank_v38,185^v2^control&utm_term=docker-compose&spm=1018.2226.3001.4187)