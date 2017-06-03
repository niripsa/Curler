<?php
return array(
	//'配置项'=>'配置值'
  'DB_TYPE' => 'mysqli',
  'DB_HOST' => '127.0.0.1',
  'DB_NAME' => 'kekehome',
  'DB_USER' => 'root',
  'DB_PWD' => 'root',
  'DB_PREFIX' => '',
  'DB_PORT' => 3306,
  'DB_CHARSET' => 'utf8',
  'DEFAULT_MODULE' =>  'Kekehome',

  'TOKEN_ON'      =>    true,  // 是否开启令牌验证 默认关闭
  'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
  'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
  'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true
);