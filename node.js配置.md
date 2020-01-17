
## nodejs配置

### windows

1、node安装目录

    D:/Dev/nodejs 目录下

2、修改默认的全局目录

- 方法一： 到node安装目录[D:/Dev/nodejs]执行以下命令

    npm config set prefix D:/Dev/nodejs/node_global/ //全局包目录
    npm config set cache D:/Dev/nodejs/node_cache/  //全局包缓存目录

- 方法二

.npmrc位置 C:/Users/[username]/.npmrc

直接修改.npmrc文件的cache值和prefix值，文件如下：

    prefix=D:\Dev\nodejs\node_global
    cache=D:\Dev\nodejs\node_cache
    registry=https://registry.npm.taobao.org/

3、配置环境变量
 
 计算机->属性->高级系统配置->环境变量->用户变量->编辑path,添加`global“目录如下：
 
  PATH: D:\Dev\nodejs\node_global\;
  
  
#### 总结：

  不需要添加系统环境变量NODE_PATH，只需编辑用户环境变量
  包安装统一到node安装包目录，便于管理查询
  只需修改.npmrc一个文件
  之前path可能会产生影响，不生效请删除原环境path中node相关内容，尝试重启机器
  
#### 注意事项

1. npm -v 报错

查看 D:\Dev\nodejs\node_global\node_modules，删除npm包， 使用D:\Dev\nodejs\node_modules的npm
  
  
  
  
