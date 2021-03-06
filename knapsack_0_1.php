<?php
/**
 * Created by PhpStorm.
 * User: wangfeng
 * Date: 2017/3/3
 * Time: 9:43
 * 0-1背包 算法
 */

 /*
  * 第一种解法
  */
function sub($v, $w, $n, $W){
    if($n<=0 || $W<=0){
        return 0;
    }
    if($w[$n-1] > $W){
        return sub($v, $w, $n-1, $W);
    }else{
        $v1 = $v[$n-1] + sub($v, $w, $n-1, $W-$w[$n-1]);
        $v2 = sub($v, $w, $n-1, $W);
        return max($v1, $v2);
    }
}
/*
 * 第二种解法
 */
function sub2($v, $w, $i, $W){
    if($i>=count($v) || $W<=0){
        return 0;
    }
    if($w[$i] > $W){
        return sub2($v, $w, $i+1, $W);
    }else{
        $v1 = $v[$i]+sub2($v, $w, $i+1, $W-$w[$i]);
        $v2 = sub2($v, $w, $i+1, $W);
        return max($v1, $v2);
    }
}

/*
 * 非递归解法
 */
function dp($v, $w, $W){
    $dp = array();
    $n = count($v);
    for($i=0;$i<=$n;$i++){
        for($j=0; $j<=$W; $j++){
            if($i==0 || $j==0){
                $dp[$i][$j] = 0;
            }else{
                if($w[$i-1]>$j){
                    $dp[$i][$j] = $dp[$i-1][$j];
                }else{
                    $dp[$i][$j] = max($dp[$i-1][$j-$w[$i-1]]+$v[$i-1], $dp[$i-1][$j]);
                }
            }
        }
    }
    return $dp[$n][$W];
}

$v = array(10, 15, 18, 22);
$w = array(5, 4, 6, 8);
$W = 15;
$sum = 0;
$sum = sub($v, $w, count($v), $W);
echo $sum . PHP_EOL;

$sum = sub2($v, $w, 0, $W);
echo $sum .PHP_EOL;

$sum = dp($v, $w, $W);
echo $sum . PHP_EOL;