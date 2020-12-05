# :tada: Laravue
Laravel+vue+admin 实现了JWT鉴权，动态路由菜单管理，角色管理，权限管理，数据字典，一键生成crud代码,RESTful API风格,Laravel ORM,更多功能正在实现中，
欢迎各位PR和issue
## :cake: 项目预览
###### 仪表盘
![index.png](https://i.loli.net/2020/11/22/JeApBcPHONZ3bsG.png)

###### 菜单管理
![menu.png](https://i.loli.net/2020/11/22/EvgUVTZPJaIm6lN.png)

###### 角色管理
![role.png](https://i.loli.net/2020/11/22/XR1dAuVchp2LQyD.png)

###### 数据字典
![zidian.png](https://i.loli.net/2020/11/22/lTWLzi4BdU3A8oX.png)


## :cake: 启动步骤
```

/** 后台 */
cd Laravue
cd laravel
rm composer.lock(选)
composer install(提前配置好国内镜像地址)
安装数据库(/database/laravel.sql)
配置数据库（.env）

/** 前台 */
cd Laravue
cd admin
rm package-lock.json(选)
npm install(提前配置好国内镜像地址)
npm run serve

/** 账户密码 */

测试用户名：admin

测试密码：123456

/** 部署 */
npm run build

/** 备注 */
如果用于商业项目，建议重新生成自己的key 和jwt-key

```

## :tada: Laravue一键生成CRUD代码

#### :four_leaf_clover: 综述
计划的自动化代码生成实现方式有两种
第一种是先设计好数据表，到页面上选择数据表，调整个别字段，一键生成所有代码
第二种是直接在页面上设计表字段，自动化生成代码的同时并自动创建数据库，开发中...

![autoCode.png](https://i.loli.net/2020/12/05/MT6BnaZdi4ozWyR.png)

#### :four_leaf_clover: 实现方案一
 - 第一步：设计好数据表
 - 第二步：导入数据表
 - 第三步：设计命名空间（或业务模块名）
 - 第四步：设计查询字段
 - 第五步：生成代码（选同时代码实现）
#### :four_leaf_clover: 实现方案二
敬请期待...

### :cake: 微信交流群
加群请回复 `加群`
| 微信 |
| :---:| 
| <img width="300" src="https://i.loli.net/2020/11/22/phXRNIdOtDf8lkS.jpg"> |

## :cake: 联系作者
欢迎各位联系作者，协助使用，反馈错误,
| 微信 |
| :---:| 
| <img width="300" src="https://i.loli.net/2020/11/22/phXRNIdOtDf8lkS.jpg"> |

## :cake: 特别鸣谢
特别鸣谢[flipped-aurora](https://github.com/flipped-aurora地址)团队
特别鸣谢[gin-vue-admin](https://github.com/flipped-aurora/gin-vue-admin)项目，如果大家有GO语言学习和需要GO语言的后台管理框架的，请[点击链接跳转](https://github.com/flipped-aurora/gin-vue-admin)
