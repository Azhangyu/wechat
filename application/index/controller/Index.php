<?php
// +----------------------------------------------------------------------
// | 海豚PHP框架 [ DolphinPHP ]
// +----------------------------------------------------------------------
// | 版权所有 2016~2017 河源市卓锐科技有限公司 [ http://www.zrthink.com ]
// +----------------------------------------------------------------------
// | 官方网站: http://dolphinphp.com
// +----------------------------------------------------------------------
// | 开源协议 ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------

namespace app\index\controller;
use app\cms\model\Activity;
use app\cms\model\Notice;
use app\cms\model\Online;
use app\cms\model\Service;
use app\cms\model\Shop;
use app\cms\model\Zushou;

/**
 * 前台首页控制器
 * @package app\index\controller
 */
class Index extends Home
{
    public function index()
    {

          return $this->fetch();

    }
    public function notice(){
        $notices = Notice::all();
//        dump($notices);exit;
        $this->assign('notices',$notices);
        return $this->fetch();
    }

    public function notice_detail($id)
    {
        $notices = Notice::get($id);
//        dump($notices);exit;
        $this->assign('notices',$notices);
        return $this->fetch();
    }

    public function service()
    {
        $service = Service::all();
        $this->assign('services',$service);
        return $this->fetch();
    }
    public function service_detail($id)
    {
        $service = Service::get($id);
        $this->assign('services',$service);
        return $this->fetch();
    }

    public function shop()
{
    $shops = Shop::all();
    $this->assign('shops',$shops);
    return $this->fetch();
 }
    public function shop_detail($id)
    {
        $shops = Shop::get($id);
        $this->assign('shops',$shops);
        return $this->fetch();
    }

    public function activity()
    {
      $activitys = Activity::all();
      $this->assign('activitys',$activitys);
      return $this->fetch();
    }
    public function activity_detail($id)
    {
//        dump($id);exit;
        $activitys = Activity::get($id);
//        dump($activitys);exit;
        $this->assign('activitys',$activitys);
        return $this->fetch();
    }

    public function zushou()
    {
        $zus = Zushou::all(['type'=>1]);
        $shous = Zushou::all(['type'=>0]);
//        dump($zu);exit;
        $this->assign('zus',$zus);
        $this->assign('shous',$shous);
        return $this->fetch();
   }

    public function zushou_detail($id)
    {
        $zushou = Zushou::get($id);
        $this->assign('zushou',$zushou);
        return $this->fetch();
   }

    public function online()
    {
//        dump(time());exit;
        if ($this->request->Post()) {
            $onlineModel = new Online();
            //生成唯一单号
            $sn =   date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
            //报修时间

            $data = input('post.');
            $onlineModel->sn = $sn;
            $onlineModel->start_time=time();
            //状态标记为未处理
            $onlineModel->status = 0;
            $onlineModel->save($data);
            $this->success('申请保修成功,正在为您跳转到主页','index');
        }
        return $this->fetch();
   }

    public function my()
    {
      $user= session('user');
      if($user===null){
          $this->error('您还未登录','login/login');
      }
        $this->assign('user',$user);
        return $this->fetch();
   }
}
