<?php
/**
 * /**
 * ====云招科技笔试题======
 * 笔试题连接：https://www.zhihu.com/question/19757909
 * 第6题
 */
function sighandler($signo){
    echo 'caught signal SIGINT',"\n";
    exit();
}
declare(ticks=1);
pcntl_signal(SIGINT,"sighandler");

while (1) {
    echo "\n\n";
    echo "I am doing something important\n";
    echo "if i am interruptted, the data will be corrupted\n";
    echo "be careful\n";
    echo "\n\n";
    sleep(3);
}


?>