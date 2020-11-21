# :tada: Laravue
Laravel+vue+admin 实现了JWT鉴权，动态路由菜单管理，角色管理，权限管理，数据字典，一键生成crud代码,更多功能正在实现中，欢迎各位PR和issue

## :cake: 特别鸣谢
特别鸣谢[flipped-aurora](https://github.com/flipped-aurora地址)团队
特别鸣谢[gin-vue-admin](https://github.com/flipped-aurora/gin-vue-admin)项目，如果大家有GO语言学习和需要GO语言的后台管理框架的，请[点击链接跳转](https://github.com/flipped-aurora/gin-vue-admin)

## :cake: 项目预览
###### 仪表盘
![index](/markdown/index.png)

###### 菜单管理
![index](/markdown/menu.png)

###### 角色管理
![index](/markdown/role.png)

###### 数据字典
![index](/markdown/zidian.png)


## :cake: 启动步骤
```

/** 后台 */
cd Laravue
cd laravel
rm composer.lock(选)
composer install
安装数据库(/database/laravel.sql)
配置数据库（.env）

/** 前台 */
cd Laravue
cd admin
rm package-lock.json(选)
npm install(提前配置好镜像地址)
npm run serve

/** 账户密码 */

测试用户名：admin

测试密码：123456

/** 部署 */
npm run build

/** 备注 */
如果用于商业项目，建议重新生成自己的key 和jwt-key

```

### 微信交流群
| 微信 |
| :---:| 
| <img width="300" src="/markdown/author.jpg"> 

## :cake: 联系作者
欢迎各位联系作者，协助使用，反馈错误,
| 微信 |
| :---:| 
| <img width="300" src="/markdown/author.jpg"> 