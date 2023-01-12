<?php
    $table = $_GET["table"];
    $num    = $_GET["num"];
    $ripple_num   = $_GET["ripple_num"];
    $page   = $_GET["page"];

    $table_ripple = $table."_ripple";

    include "../include/db_connect.php";
    $sql = "delete from $table_ripple where num=$ripple_num"; // 레코드 삭제 명령

    mysqli_query($con, $sql);     // SQL 명령 실행

    mysqli_close($con);           // DB 접속 해제

    // 목록보기 이동
    echo "<script>
	         location.href = 'index.php?type=view&table=$table&num=$num';
	     </script>";
?>