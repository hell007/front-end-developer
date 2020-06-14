## nginx


### 安装Nginx

	brew install nginx

###  启动和关闭
	nginx
	nginx -s quit
	
	nginx -s reload|reopen|stop|quit
	
	


## nginx 知识



$ brew services start nginx  //启动

## 负载均衡模块
# weight 是权重，可以根据机器配置定义权重。weigth 参数表示权值，权值越高被分配到的几率越大
upstream my_server{
	  server 220.165.143.82:666;
    # server 121.42.13.42:80;
    # server 192.168.60.121:80 weight=3;
  	# server 192.168.60.122:80 weight=2;
}


## 虚拟主机的配置
server{
    listen 80;
    server_name localhost;
    # server_name localhost www.kunyujie.com; #用来指定IP地址或者域名，多个域名之间用空格分开
    charset utf-8;


    # 图片缓存时间设置
	# location ~ .*.(gif|jpg|jpeg|png|bmp|swf)$ {
	#	expires 10d;
	# }


	# JS和CSS缓存时间设置
	# location ~ .*.(js|css)?$ {
	# expires 1h;
	# }
    
    

    # 反向代理 对'/'启用反向代理
    location / {
    	# 设置要代理的 uri，注意最后的 /。可以是 Unix 域套接字路径，也可以是正则表达式
    	proxy_pass http://127.0.0.1:3000/;
    	# 设置后端服务器“Location”响应头和“Refresh”响应头的替换文本
    	proxy_redirect off; 
    	# 获取用户的真实 IP 地址
    	proxy_set_header X-Real-IP $remote_addr; 
		# 后端的Web服务器可以通过 X-Forwarded-For 获取用户真实IP
		proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;

		## 以下是一些反向代理的配置，可选
    	# 允许重新定义或者添加发往后端服务器的请求头
        proxy_set_header Host $host;
        # 允许客户端请求的最大单文件字节数
        client_max_body_size 10m; 
        # 缓冲区代理缓冲用户端请求的最大字节数
		client_body_buffer_size 128k; 
		# nginx跟后端服务器连接超时时间(代理连接超时)
		proxy_connect_timeout 90; 
		# 后端服务器数据回传时间(代理发送超时)
		proxy_send_timeout 90; 
		# 连接成功后，后端服务器响应时间(代理接收超时)
		proxy_read_timeout 90;
		# 设置代理服务器（nginx）保存用户头信息的缓冲区大小
		proxy_buffer_size 4k; 
		# proxy_buffers缓冲区，网页平均在32k以下的设置
		proxy_buffers 4 32k; 
		# 高负荷下缓冲大小（proxy_buffers*2）
		proxy_busy_buffers_size 64k; 
		# 设定缓存文件夹大小，大于这个值，将从upstream服务器传
		proxy_temp_file_write_size 64k;
        
    }


    location ^~ /api/ {
        #121.42.13.42
        proxy_pass http://my_server/;
        # proxy_pass http://192.168.60.245:8080/;
  		proxy_redirect      default;
    }


    # 本地动静分离反向代理配置
	# 所有 jsp 的页面均交由tomcat或resin处理
	location ~ .(jsp|jspx|do)?$ {
	  proxy_set_header Host $host;
	  proxy_set_header X-Real-IP $remote_addr;
	  proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
	  proxy_pass http://127.0.0.1:8080;
	}


	# 所有静态文件由nginx直接读取不经过tomcat或resin
	# location ~ .*.(htm|html|gif|jpg|jpeg|png|bmp|swf|ioc|rar|zip|txt|flv|mid|doc|ppt|pdf|xls|mp3|wma)${
	#  root    /data/www/ospring.pw/public;
	#  expires 15d;
	# }



	# location ~ ^/(upload|html)/  {
	#  root    /data/www/ospring.pw/public/html;
	#  expires 30d;
	# }
    
}