
<ul class="board_list">
<p>CHARGE&ensp;POINT</p>
<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache, must-revalidate");
if(!$userid) {
?>
    <table class="type05">
        <td><?php echo "<font color='#ffffff' size='7'>PLEASE,&ensp;LOGIN&ensp;FIRST</font>"; ?></td>
    </table>
<?php
} else {
include "../include/db_connect.php";
$sql = "select * from _mem where id='$userid'";	//
$result = mysqli_query($con, $sql);			// SQL 명령 실행

$board=mysqli_fetch_array($result);

$money = $board['point'];
$userid = $board['id'];

function point_level($m){ // 레벨 변경 함수
global $userid; //유저 아이디 불러옴
include "../include/db_connect.php";
if($m <= 20000){
$sql = "UPDATE _mem SET level = '서울역' where id='$userid'";
mysqli_query($con, $sql);
}
if($m > 20000){
$sql = "UPDATE _mem SET level = '판자집' where id='$userid'";
mysqli_query($con, $sql);
}
if($m > 40000){
$sql = "UPDATE _mem SET level = '원룸' where id='$userid'";
mysqli_query($con, $sql);
}
if($m > 80000){
$sql = "UPDATE _mem SET level = '빌라' where id='$userid'";
mysqli_query($con, $sql);
}
if($m > 160000){
$sql = "UPDATE _mem SET level = '아파트' where id='$userid'";
mysqli_query($con, $sql);
}
if($m > 320000) {
$sql = "UPDATE _mem SET level = '신세계의 신' where id='$userid'";
mysqli_query($con, $sql);
}
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>주사위 놀이</title>
<style>
table {
width: 100%;
margin-top: 7%;
}
</style>
</head>
<body>
<table class="type09">
    <thead>
    <tr>
        <th scope="cols">이름</th>
        <th scope="cols">등급</th>
        <th scope="cols">보유 포인트</th>
    </tr>
    </thead>
<tbody>
<tr>
<td><?php echo $board['name']; ?></td>
<td><?php echo $board['level']; ?></td>
<td><?php echo $board['point']; ?></td>
</tr>
</tbody>
</table>
</br>
<form method="post">
<input id="input4" type="text" name="bt_money" placeholder="위 문장을 여기에 적어주세요" required>
<input id="input5" type="submit" name="one_s" id="one_s" value="입력" />
</form>
<?php
?>
<?php
$re_m = 0;
$rand_str = "제발 포인트 충전 부탁드립니다";
?>
<table class="type04">
<tbody>
<td><?php echo "<font color='#ffffff' size='6''>$rand_str</font>"; ?></td>
</tbody>
</table>
<?php
    if(array_key_exists('one_s',$_POST)){
    $bt_money = $_POST[ 'bt_money' ];
        if($bt_money === $rand_str){
        $rd_mo = rand(1,300);
?>
        <table class="type03">
        <thead>
        <td><?php echo "<font color='#ffffff' size='3'>+ $rd_mo 포인트 충전 완료</font>"; ?></td>
        </thead>
        </table>
        <?php
        $money += $rd_mo;
        $sql = "UPDATE _mem SET point = '$money' where id='$userid'";
        mysqli_query($con, $sql);
            echo ("<meta http-equiv='Refresh' content='1; url=../mboard/index.php?type=list3&table=_mem&<?=$userid?>'>");
            goto A;
        }
        else{
        ?>
        <table class="type03">
        <thead>
        <td><?php echo "<font color='#ffffff' size='3'>다시 입력해주세요</font>"; ?></td>
        </thead>
        </table>
        <?php
}
}
A:
}

?>
</body>
</html>