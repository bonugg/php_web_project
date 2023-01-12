<?php
    session_start();

    if (isset($_SESSION["userid"]))
        $userid = $_SESSION["userid"];
    else {
        $userid = "";
    }

    if (isset($_SESSION["username"]))
        $username = $_SESSION["username"];
    else
        $username = "";

	if (!$userid) {
		echo "
				<script>
				alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
				history.go(-1)
				</script>
		";
		exit;
	}

	$table = $_GET["table"];
	$num = $_GET["num"];
	$page = $_GET["page"];

	$table_ripple = $table."_ripple";


    $ripple_content = $_POST["ripple_content"];
    $ripple_content = htmlspecialchars($ripple_content, ENT_QUOTES);
    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장


    if(!$userid) {
        echo "
	        <script>
	        window.alert('로그인 후 이용하세요.')
	        history.go(-1)
	        </script>
	        ";
	    exit;
    }

    include "../include/db_connect.php";
    $sql = "insert into $table_ripple (parent, id, name, content, regist_day) ";
    $sql .= "values($num, '$userid', '$username', '$ripple_content', '$regist_day')";

    mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

	mysqli_close($con);       // DB 연결 끊기

	// 목록 페이지로 이동
	echo "<script>
	    location.href = 'index.php?type=view&table=$table&num=$num&page=$page';
	   </script>";

?>


