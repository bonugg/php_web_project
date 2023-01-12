<div class="notice">
    <p>NOTICE&ensp;BOARD</p></br>

    <?php
include "../include/db_connect.php";

$sql = "select * from _notice order by num desc limit 5";
$result = mysqli_query($con, $sql);
$a=1;
$b=1;
while($row = mysqli_fetch_assoc($result)) {
    $num    = $row["num"];
    $name    = $row["name"];
    $date    = $row["regist_day"];
    $date = substr($date, 0, 10);
    $subject = $row["subject"];
    $subject = htmlspecialchars_decode($subject, ENT_QUOTES);
    ?>

<div class="item">
</br></br>
    <?php if($a == 1){ ?>
    <div style="width: 30%; height:40px; float: left;">
        <p2><a href="../mboard/index.php?type=view&table=_notice&num=<?=$num?>&page=1">&ensp;<?=$subject?></a></p2>
    </div>
        <div style="width: 65%; height:40px; float: right;">
        <p3><font color="gray"><?=$date?></font></p3>&nbsp; &nbsp;</div>
    </div>
<?php
        $a += 1;
    }else if($a == 2) {?>
    <div style="width: 30%; height:40px; float: left;">
        <p4><a href="../mboard/index.php?type=view&table=_notice&num=<?=$num?>&page=1">&ensp;<?=$subject?></a></p4>
    </div>
    <div style="width: 65%; height:40px; float: right;">
        <p5><font color="gray"><?=$date?></font></p5>&nbsp; &nbsp;</div>
</div>
        <?php $a += 1;
    }else if($a == 3) {?>
            <div style="width: 30%; height:40px; float: left;">
                <p6><a href="../mboard/index.php?type=view&table=_notice&num=<?=$num?>&page=1">&ensp;<?=$subject?></a></p6>
            </div>
            <div style="width: 65%; height:40px; float: right;">
                <p7><font color="gray"><?=$date?></font></p7>&nbsp; &nbsp;</div>
            </div>
            <?php
            $a += 1;
        }else if($a == 4) {?>
            <div style="width: 30%; height:40px; float: left;">
                <p8><a href="../mboard/index.php?type=view&table=_notice&num=<?=$num?>&page=1">&ensp;<?=$subject?></a></p8>
            </div>
            <div style="width: 65%; height:40px; float: right;">
                <p9><font color="gray"><?=$date?></font></p9>&nbsp; &nbsp;</div>
            </div>
            <?php
            $a += 1;
        }else if($a == 5) {?>
            <div style="width: 30%; height:40px; float: left;">
                <p10><a href="../mboard/index.php?type=view&table=_notice&num=<?=$num?>&page=1">&ensp;<?=$subject?></a></p10>
            </div>
            <div style="width: 65%; height:40px; float: right;">
                <p11><font color="gray"><?=$date?></font></p11>&nbsp; &nbsp;</div>
            </div>
            <?php
        }
}
?>
</div> <!-- 공지게시판 끝 -->