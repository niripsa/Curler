<?php
namespace Kekehome\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display('fileinput');
    }
}