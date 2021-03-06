##  npm vs yarn

### 1、npm  / cnpm

npm 使用

### 2、yarn

安装
  
    npm i -g yarn
    
在项目根目录运行

    yarn upgrade-interactive  --latest


### 3、拓展


- 注意： 使用 npm-check 更新项目依赖：

项目依赖更新检查

    npm i -g npm-check
    
在项目根目录运行

    npm-check -u
    
    
- 检测原理：

yarn 是根据 yarn.lock 文件来检测版本是否是最新的，所以项目是使用 npm 安装依赖包，
更新前要运行 yarn install 一下。

npm-check 是检测 package.json 文件，项目存在 node_modules 文件夹即可更新。

- 更新提醒：

没有交互就是将依赖包直接更新到最新版本，推荐使用交互式更新，会有更新的警告信息。

最新的依赖包，API 可能发生重大改变。为了顺利更新，更新前请 git commit 一下，更新失败了也能顺利回退。

- 不推荐使用 cnpm：

为了加快安装依赖的安装速度，可能被同事安利 cnpm，但是这样会导致包的依赖安装不正常，项目无法运行。

更好的做法是使用 nrm 切换下载源。

平时使用 yarn 装包，npm 运行脚本。


### 4、切换镜像源

安装 nrm
  
    npm i -g nrm 

查看下载镜像源

    nrm ls
    
输出如下

      npm ---- https://registry.npmjs.org/
      cnpm --- http://r.cnpmjs.org/
    * taobao - https://registry.npm.taobao.org/
      nj ----- https://registry.nodejitsu.com/
      npmMirror  https://skimdb.npmjs.com/registry/
      edunpm - http://registry.enpmjs.org/
      
切换镜像源

    nrm use taobao

使用

    //npm
    npm i --save core-js
    //yarn
    yarn add core-js
    
    
 ### 5、CLI 命令比较
 
![](./images/npm-yarn-command.jpg)

 

