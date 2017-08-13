<?php
namespace Admin\Controller;

use Think\Page;

class RepairController extends AdminController{
    //报修列表
    public function index(){
        $Repair = M('Repair'); // 实例化User对象
        $count= $Repair->where('status=1')->count();// 查询满足要求的总记录数
        $Page = new Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $Repair->where('status=1')->order('create_time')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->meta_title = '报修管理';
        $this->display(); // 输出模板

    }
    //添加报修
    public function add(){
        if(IS_POST){
            $Repair = D('Repair');
            $data = $Repair->create();
            if($data){
                $id = $Repair->add();
                if($id){
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_repair', 'repair', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Repair->getError());
            }
        } else {
            $this->assign('info',null);
            $this->meta_title = '新增导航';
            $this->display('edit');
        }
    }
    //修改报修
    public function edit($id = 0){
        if(IS_POST){
            $Repair = D('Repair');
            $data = $Repair->create();
//            var_dump($data);exit;
            if($data){
//                var_dump($data);exit;
                if($Repair->save($data)){
                    //记录行为
//                    action_log('update_repair', 'repair', $data['id'], UID);
                    $this->success('编辑成功', U('index'));
                } else {
//                    echo $Repair->getLastSql();exit;
                    $this->error('编辑失败');
                }

            } else {
                $this->error($Repair->getError());
            }
        } else {

            $info = array();
            /* 获取数据 */
            $info = M('Repair')->find($id);
//            var_dump($info);exit;
           if(false === $info){
                $this->error('获取配置信息错误');
            }

            $this->assign('info', $info);
            $this->meta_title = '编辑导航';
            $this->display();
        }
    }

    //删除报修
    public function del(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(M('Repair')->where($map)->delete()){
            //记录行为
            action_log('update_repair', 'repair', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

}