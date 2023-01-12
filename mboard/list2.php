<ul class="board_list">
<p>DICE&ensp;GAME</p>
<?php
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
<input id="input1" type="text" name="bt_money" placeholder="배팅금액을 입력하세요" required>
<input id="input2" type="submit" name="one_s" id="one_s" value="1번에게 배팅" />
<input id="input3" type="submit" name="two_s" id="one_s" value="2번에게 배팅" /><br/><br/>
</form>
<?php
?>
<?php
$s_1 = 0;
$s_2 = 0;
$re_m = 0;
$a = 0;
if(array_key_exists('one_s',$_POST) || array_key_exists('two_s',$_POST)){
$bt_money = $_POST[ 'bt_money' ];
if($bt_money > $money){
?>
<table class="type06_2">
<td><?php echo "<font color='white' size='6'>배팅금액 초과</font>"; ?></td>
</table>
<?php
$bt_money = 0;
}else{
$a =1;
?>
<img id='image' src='../img/sample.gif'>
<?php
$money -= $bt_money;
?>
<table class="type08">
<?php $dice = rand(1,6); $dice2 = rand(1,6); $player1 = $dice + $dice2; ?>
<td><?php echo "<font color='white' size='5'>플레이어1</font><br/>"; ?>
    <?php echo "<font color='white' size='10'>".$player1.'점</font><br/><br/>'; ?></td>
</table>

<table class="type07">
    <?php $dice = rand(1,6); $dice2 = rand(1,6); $player2 = $dice + $dice2; ?>
    <td><?php echo "<font color='white' size='5'>플레이어2</font><br/>"; ?>
        <?php echo "<font color='white' size='10'>".$player2.'점</font><br/><br/>'; ?></td>
</table>

<table class="type06">
<thead>
<tr>
<th scope="cols"></th>
</tr>
</thead>
<tbody>
<?php
if ($player1 < $player2) {
$s_2 = 1;
?>
<tr>
<td><?php echo "<font color='#FFFFFF' size='6'>플레이어2 WIN!</font>"; ?></td>
</tr>
<?php
if ($s_2 == 1 && array_key_exists('two_s',$_POST)) {
?>
<tr>
<td><?php echo "<font color='#FFFFFF' size='5'>2번 배팅</font><font color='blue' size='5'> 성공</font>"; ?></td>
</tr>
<?php
$re_m = $bt_money * 2;
$money += $re_m;
point_level($money);
$sql = "UPDATE _mem SET point = '$money' where id='$userid'";
mysqli_query($con, $sql);
    echo ("<meta http-equiv='Refresh' content='2; url=../mboard/index.php?type=list2&table=_mem&<?=$userid?>'>");0
}
else if ($s_2 == 1 && array_key_exists('one_s',$_POST)) {
?>
<tr>
<td><?php echo "<font color='#FFFFFF' size='5'>1번 배팅</font><font color='red' size='5'> 실패</font>"; ?></td>
</tr>
<?php
point_level($money);
$sql = "UPDATE _mem SET point = '$money' where id='$userid'";
mysqli_query($con, $sql);
    echo ("<meta http-equiv='Refresh' content='2; url=../mboard/index.php?type=list2&table=_mem&<?=$userid?>'>");
}
}
else if ($player1 > $player2) {
$s_1 = 1;
?>
<tr>
<td><?php echo "<font color='#FFFFFF' size='6'>플레이어1 WIN!</font>"; ?></td>
</tr>
<?php
if ($s_1 == 1 && array_key_exists('one_s',$_POST)) {
?>
<tr>
<td><?php echo "<font color='#FFFFFF' size='5'>1번 배팅</font><font color='blue' size='5'> 성공</font>"; ?></td>
</tr>
<?php
$re_m = $bt_money * 2;
$money += $re_m;
point_level($money);
$sql = "UPDATE _mem SET point = '$money' where id='$userid'";
mysqli_query($con, $sql);
    echo ("<meta http-equiv='Refresh' content='2; url=../mboard/index.php?type=list2&table=_mem&<?=$userid?>'>");
}
else if ($s_1 == 1 && array_key_exists('two_s',$_POST)) {
?>
<tr>
<td><?php echo "<font color='#FFFFFF' size='5'>2번 배팅</font><font color='red' size='5'> 실패</font>"; ?></td>
</tr>
<?php
point_level($money);
$sql = "UPDATE _mem SET point = '$money' where id='$userid'";
mysqli_query($con, $sql);
    echo ("<meta http-equiv='Refresh' content='2; url=../mboard/index.php?type=list2&table=_mem&<?=$userid?>'>");
}
}
else if ($player1 == $player2) {
?>
<tr>
<td><?php echo "<font color='#FFFFFF' size='6'>동점이에요 다시...</font>"; ?></td>
</tr>
<?php
$money += $bt_money;
point_level($money);
$sql = "UPDATE _mem SET point = '$money' where id='$userid'";
mysqli_query($con, $sql);
    echo ("<meta http-equiv='Refresh' content='2; url=../mboard/index.php?type=list2&table=_mem&<?=$userid?>'>");
}
?>
</tbody>
</table>
</br>
<?php
}
}
}
?>
</body>
</html>