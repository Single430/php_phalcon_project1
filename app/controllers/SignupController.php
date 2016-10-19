<?php

/**
 * Created by PhpStorm.
 * User: user01
 * Date: 16-10-19
 * Time: 下午12:05
 */

class SignupController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function registerAction()
    {
//        $user = new Users();
        // 存储和检验错误
        $servername = "127.0.0.1";
        $username = "root";
        $password = "123456";
        $dbname = "test_store_db";
        //创建连接
        $conn = new mysqli($servername, $username, $password, $dbname);

        // 检测连接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }
        echo "连接成功"."<br>";

        $name=$this->request->getPost('name');
        $email=$this->request->getPost('email');

//        echo iconv('utf-8','utf-8',$name) . iconv('gbk','utf-8',$email);
        //中文保存数据库, 防止乱码
        $conn->query("set names 'utf8'");
        $sql = "INSERT INTO users (username, email) VALUES('".iconv('utf-8','utf-8',$name)."','".$email."')";

        if ($conn->query($sql) === TRUE)
            echo "新记录插入成功";
        else
            echo "Error: " . $sql . "<br>" . $conn->error;

        $conn->close();

//        $user->name = $name;
//        $user->email = $email;
//        $success = $user->save();

//        $success = $user->save(
//            $this->request->getPost(),
//            [
//                "name",
//                "email",
//            ]
//        );

//        if ($success) {
//            echo "Thanks for registering!";
//        } else {
//            echo "Sorry, the following problems were generated: ";
//
//            $messages = $user->getMessages();
//
//            foreach ($messages as $message) {
//                echo $message, "<br/>";
//            }
//        }

        $this->view->disable();
    }
}