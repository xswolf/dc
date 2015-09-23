<?php
namespace Admin\Controller;

use Common\Controller\BaseController;
use Think\Upload;

class UploadController extends BaseController
{

    public function up()
    {
        $upload = new Upload();// 实例化上传类
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath = './Uploads/'; // 设置附件上传根目录
        $upload->savePath = ''; // 设置附件上传（子）目录
        // 上传文件
        $info = $upload->upload();
        if (!$info) {// 上传错误提示错误信息
            $error = $upload->getError();
            $this->ajaxError($error);
        } else {// 上传成功
            $this->ajaxSuccess($info);
        }
    }

}