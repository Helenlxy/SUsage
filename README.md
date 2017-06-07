## SUsage已从2017年5月20日起正式开源并重启开发。诚邀广州市乃至全国的校园技术部门参与我们。

**Zhixin StudentUnion OA System #Codename"SUsage"**

**广州市执信中学学生会 信息化在线办公系统 开源项目 #代号"SUsage"**

**目前总体开发进度：[===============100%===============]，当前Build:21C92 (20092)**

**项目总阶段：0.21-alpha1 #Project SUsage 2.0**

**Latest update：2017.5.26 21:58**

**©2017 执信学生会 电脑部**

**Created By @yyl99311 | @df7c5117 | @GhostShadowTan | @橡胶人AS | @SmallOyster**

**特别鸣谢：@SmallOyster**

[帮助文档](https://github.com/zhxsu/SUsage/wiki/%E5%B8%AE%E5%8A%A9%E4%B8%8E%E5%8F%8D%E9%A6%88%E4%B8%AD%E5%BF%83-%7C-Hints-&-Feedbacks)

### 这是个啥w

  这是执信学生会的网上办公平台。

  2017年5月20日于广州市中学生领袖峰会传媒与技术分会上宣布重启开发。


### 为啥叫这个名字w

  StudentUnion简写“SU”和Message的组合自造词。<s>让人酥酥的办公系统</s>


### 好处都有啥w

  为了方便学生会成员进行日常工作、文件共享。我们更希望它可以被各所学校自主定制并针对性地为自己提供服务。

### 配置</h3>
  本地可以使用[XAMPP1.8.2+]调试，服务器端建议最低配置[PHP5+],[Apache 2.4.17+],[phpMyAdmin 4.5.1+]
  
  请将此文件包放在**网站根目录**
  
  环境配置完成后，请在PhpMyAdmin中新建**susage**数据库后导入**susage.sql**文件。
  
  并在[functions/to_sql.php],[Admin/Includes/to_pdo.php]中，按照提示填写您的数据库账户和密码
  
  测试用户1：root 密码：123456（角色：根管理员）
  
  测试用户2：super 密码：123456（角色：超级管理员）
  
  测试用户3：admin 密码：123456（角色：管理员）
  
  测试用户4：master 密码：123456（角色：组长）
  
  测试用户5：user 密码：123456（角色：用户）
  
  **若忘记密码可打开/SUsage/sha1.php按照提示输入密码**
  
  **点击确认后将inDB复制，粘帖进数据库中 sys_user[表] -> pw[字段] 即可。**
 
### 近期重大事情

  **----2017.6.8----**

* 解决了几个UI的遗留问题
  
* 添加了认证用户功能
  
* 修复部分代码bug，精简代码。
  
* 推出了SUsage的VI设计参考。[请参考设计规范](https://github.com/zhxsu/SUsage/wiki/%E8%AE%BE%E8%AE%A1%E8%A7%84%E8%8C%83-%7C-VI-&-UI-&-UX-Guides)
  
  
  **----2017.5.20----**

  重启开发。


### 开源声明及感谢

  本项目目前基于以下几个开源项目开发：

* [`jQuery`](https://jquery.org/)，遵循`MIT`协议

* [`Bootstrap 3.3`](https://getbootstrap.com/)，遵循`MIT`协议

* Github提供的免费代码仓库


**`GNU General Public Licence `版本`3.0`**
