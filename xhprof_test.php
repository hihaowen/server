<?php
/*****************************************************************
 * Copyright (C) 2018 Ltwen.com. All Rights Reserved.
 * Licensed http://www.apache.org/licenses/LICENSE-2.0
 * 文件名称：xhprof_tst.php
 * 创 建 者：hwz <haowen.hi@gmail.com>
 * 创建日期：2018年02月01日 13:19:36
 ****************************************************************/

error_reporting(E_ALL);

xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);

for ($i = 0; $i <= 1000; $i++) {
    $a = $i * $i;
}

$xhprof_data = xhprof_disable();

$XHPROF_ROOT = "/home/work/server/xhprof";
include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_lib.php";
include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_runs.php";

$xhprof_runs = new XHProfRuns_Default();
$run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_testing");

echo "http://www.ltwen.com/xhprof/xhprof_html/index.php?run={$run_id}&source=xhprof_testing\n";
