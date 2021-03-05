## mac homebrew 常用命令

### mac 安装homebrew

安装（需要 Ruby）：

	ruby -e "$(curl -fsSL https://raw.github.com/Homebrew/homebrew/go/install)"


### 修改镜像源

	cd /usr/local/Homebrew/Library/Taps/homebrew
	
	git clone git://mirrors.ustc.edu.cn/homebrew-core.git



### 常用的命令如下

- 列出: brew list 列出已安装的软件

- 列出服务：brew services list

- 启动服务：brew services start mysql

- 搜索：brew search mysql

- 查询：brew info mysql 主要看具体的信息，比如目前的版本，依赖，安装后注意事项等

- 安装：brew install mysql

- 卸载：brew remove mysql

- 更新：brew update 这会更新 Homebrew 自己，并且使得接下来的两个操作有意义——

- 检查过时：brew outdated （是否有新版本）这回列出所有安装的软件里可以升级的那些

- 升级：brew upgrade 升级所有可以升级的软件们

- 升级：brew upgrade <xxx>   升级指定的软件

- 清理：brew cleanup 清理不需要的版本极其安装包缓存

   ```
   brew cleanup
   brew cleanup mysql
   ```

- brew home  *   —用浏览器打开

- brew deps  *   — 显示包依赖

- brew server *  —启动web服务器

- brew -help   —帮助



## nvm 安装node

安装nvm

	curl -L -o- [http://build.sankuai.com/nvm/install](http://build.sankuai.com/nvm/install) | bash
上述失败了的话试试这个：

	curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.32.1/install.sh | bash

安装node及npm

	nvm install v8.5.0



## mac 升级 node.js 的简易方法


	第一步，先查看本机node.js版本：
	$ node -v
		
	第二步，清除node.js的cache：
	$ sudo npm cache clean -f
		
	第三步，安装 n 工具，这个工具是专门用来管理node.js版本的，别怀疑这个工具的名字，是他是他就是他，他的名字就是 "n"
	$ sudo npm install -g n
		
	第四步，安装最新版本的node.js
	$ sudo n stable //升级
	
	$ sudo n 10 //降级
		
	第五步，再次查看本机的node.js版本：
	$ node -v


