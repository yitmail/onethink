<?php
/**
 * Created by PhpStorm.
 * User: yxd
 * Date: 2017/8/10
 * Time: 14:27
 */

namespace Admin\Model;

use Think\Model;

class RepairModel extends Model
{
    //自动验证
    protected $_validate = array(
        array('name', 'require', '姓名不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('tel', 'require', '电话不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('address', 'require', '地址不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
      //  array('url', 'require', 'URL不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );
    //自动完成
    protected $_auto = array(
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', '1', self::MODEL_BOTH),
    );
}