<?php

namespace app\index\controller;

use think\Config;
use \think\Controller;
use \think\Request;
use \think\Db;
use \think\Session;
use \think\Cookie;


class Eqx extends Controller
{

    //-------------------------------------易企秀----------------------------------------------
    /*
    * add_index——添加页
    * 关联common：createJianc（生成session）
    */
    public function add_index()
    {
        //生成session用来判断二次提交
        $add_Jianc=createJianc();

        Config::set('default_ajax_return', 'html');
        return $this->fetch('Eqx/add_index');
    }

    /*
     * list_index——列表页
     * 数据表：my_exq（易企秀表）
     */
    public function list_index()
    {
        //列表页where值
        $get=Request::instance()->get('where');
        if ($get){
            $eqx_list_where['eqx_isstate']=$get;
        }else{
            $eqx_list_where=null;
        }
        //查询易企秀的列表数据
        $eqx_list = Db::name('eqx')->field('eqx_id as id,eqx_title as title,eqx_isstate as isstate')->where($eqx_list_where)->select();
        //模板输出
        $this->assign('eqx_list',$eqx_list);
        //输出格式
        Config::set('default_ajax_return', 'html');
        return $this->fetch('Eqx/list');
    }

    //------------------------------------------------易企秀-添加操作-----------------------------------------
    /*
      * eqx_add——易企秀-添加操作
      * 数据表：my_exq（易企秀表）
      * 基础规则：判断数据、SQL注入、xss注入、图片上传判断,图片宽高
      * 关联common：checkJianc(判断session,防止二次提交也可以防止远程提交)
      */
    public function eqx_add()
    {
        //接值
        $request = Request::instance();

        //判断是否二次提交和远程提交
        $add_Jianc=$request->post('add_Jianc');
        if(checkJianc($add_Jianc)== false) return json( 'jianc_no');

        // 获取上传图片
        $simg=$request->post('toutuval', '', 'trim,htmlspecialchars,addslashes');
        $himg=$request->post('datuval', '', 'trim,htmlspecialchars,addslashes');

        if (empty($simg)) return json( 'toutu_no');
        if (empty($himg)) return json( 'datu_no');

        //易企秀上传信息赋值
        $data = array(
//            'eqx_id' =>$request->post('id','','trim,htmlspecialchars,addslashes'),
            'eqx_title' => $request->post('title', '', 'trim,htmlspecialchars,addslashes'),
            'eqx_subheading' => $request->post('subheading', '', 'trim,htmlspecialchars,addslashes'),
            'eqx_url' => $request->post('url', '', 'trim,htmlspecialchars,addslashes'),
            'eqx_industry' => $request->post('industry', '', 'trim,htmlspecialchars,addslashes'),
            'eqx_type' => $request->post('type', '', 'trim,htmlspecialchars,addslashes'),
            'eqx_code' => $request->post('code', '', 'trim,htmlspecialchars,addslashes'),
            'eqx_simg' => str_replace("\\\\","/",$simg),
            'eqx_himg' => str_replace("\\\\","/",$himg),
            'eqx_adduesr' => $request->cookie('my_money_user'),
            'eqx_addtime' => time(),
            'eqx_publishtime' => $request->post('publishtime', '', 'trim,htmlspecialchars,addslashes')
        );
        $exq = Db::name('eqx')->insertGetId($data);
        if (!empty($exq)) {

            $arr = 'eqx_ok';//添加成功

        } else {
            $arr = 'eqx_no';//添加失败
        }

            return json($arr);
        }

    //-------------------------------------易企秀----------------------------------------------
    /*
    * edit_index——修改页
    * 数据表：my_exq（易企秀表）
    * 关联common：createJianc（生成session）
    */
    public function edit_index()
    {
        //生成session用来判断二次提交
        $add_Jianc=createJianc();

        //传值
        $request= Request::instance();

        //where参数，sql语句
        $edit_where['eqx_id']=$request->get('id','','trim');
        $edit=Db::name('eqx')->where($edit_where)->field('eqx_id as id,eqx_title as title,eqx_subheading as subheading,eqx_url as url,eqx_industry as industry,eqx_type as type,eqx_code as code,eqx_simg as simg,eqx_himg as himg,eqx_publishtime as publishtime')->find();

        //赋值
        $this->assign('edit',$edit);
        //输出模板
        Config::set('default_ajax_return', 'html');
        return $this->fetch('Eqx/add_index');
    }
    /*
      * eqx_edit——易企秀-修改操作
      * 数据表：my_exq（易企秀表）
      * 基础规则：判断数据、SQL注入、xss注入、图片上传判断,图片宽高
      * 关联common：checkJianc(判断session,防止二次提交也可以防止远程提交)
      */
    public function eqx_edit()
    {
        //接值
        $request = Request::instance();
        //判断是否二次提交和远程提交
        $add_Jianc=$request->post('add_Jianc');
        if(checkJianc($add_Jianc)== false) return json( 'jianc_no');
        // 获取表单上传图片
        $file = request()->file('pic1');
        $files = request()->file('pic2');

        // 获取表单上传图片
        $edit_simg=input('edit_simg');
        $edit_himg=input('edit_himg');
        $toutuval=$request->post('toutuval','', 'trim,htmlspecialchars,addslashes');
        $datuval=$request->post('datuval','', 'trim,htmlspecialchars,addslashes');
        if (empty($toutuval)){
            $simg=$edit_simg;
        }else{
            $simg=str_replace("\\\\","/",$toutuval);
        }
        if (empty($datuval)){
            $himg=$edit_himg;
        }else{
            $himg=str_replace("\\\\","/",$datuval);
        }
        //易企秀上传信息赋值
        $edit_where['eqx_id']=$request->post('edit_id');
        $data = array(
//            'eqx_id' =>$request->post('id','','trim,htmlspecialchars,addslashes'),
            'eqx_title' => $request->post('title', '', 'trim,htmlspecialchars,addslashes'),
            'eqx_subheading' => $request->post('subheading', '', 'trim,htmlspecialchars,addslashes'),
            'eqx_url' => $request->post('url', '', 'trim,htmlspecialchars,addslashes'),
            'eqx_industry' => $request->post('industry', '', 'trim,htmlspecialchars,addslashes'),
            'eqx_type' => $request->post('type', '', 'trim,htmlspecialchars,addslashes'),
            'eqx_code' => $request->post('code', '', 'trim,htmlspecialchars,addslashes'),
            'eqx_simg' => $simg,
            'eqx_himg' => $himg,
            'eqx_publishtime' => $request->post('publishtime', '', 'trim,htmlspecialchars,addslashes')
        );
        $exq = Db::name('eqx')->where($edit_where)->update($data);
        if ($exq  !==   false ) {
            //新图片上传 删除旧图片
            if (!empty($toutuval))   @unlink('../public/'.$request->post('edit_name','', 'trim,htmlspecialchars,addslashes').'/'.$edit_simg);
            if (!empty($datuval))   @unlink('../public/'.$request->post('edit_name','', 'trim,htmlspecialchars,addslashes').'/'.$edit_himg);
            $arr = 'eqx_ok';//修改成功
        } else {
            $arr = 'eqx_no';//修改失败
        }
        return json($arr);
    }
}
