<?php
//财务相关控制器
Class FinancialAction extends CommonAction{


    //可售额度明细
    public function keshou(){
        $data = M('keshoudetail');
        import('ORG.Util.Page');
        $map['member'] = session('username');
        $count = $data->where($map)->count();
        $page = new Page($count, 10);
        $page->setConfig('theme', '%first% %upPage% %linkPage% %downPage% %end%');
        $show = $page->show();// 分页显示输出
        $list = $data->where($map)->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();


        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->display();
    }
    //矿池钱包明细
    public function kcqb(){
        $data = M('jinbidetail');
        import('ORG.Util.Page');
        $map['member'] = session('username');
        $count = $data->where($map)->count();
        $page = new Page($count, 10);
        $page->setConfig('theme', '%first% %upPage% %linkPage% %downPage% %end%');
        $show = $page->show();// 分页显示输出
        $list = $data->where($map)->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();


        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->display();
    }

    //矿池资产明细
    public function kczc(){
        $data = M('zichandetail');
        import('ORG.Util.Page');
        $map['member'] = session('username');
        $count = $data->where($map)->count();
        $page = new Page($count, 10);
        $page->setConfig('theme', '%first% %upPage% %linkPage% %downPage% %end%');
        $show = $page->show();// 分页显示输出
        $list = $data->where($map)->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();


        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->display();
    }

    //冻结可售明细
    public function djks(){
        $data = M('dongjiedetail');
        import('ORG.Util.Page');
        $map['member'] = session('username');
        $count = $data->where($map)->count();
        $page = new Page($count, 10);
        $page->setConfig('theme', '%first% %upPage% %linkPage% %downPage% %end%');
        $show = $page->show();// 分页显示输出
        $list = $data->where($map)->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();


        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->display();
    }



    }




?>