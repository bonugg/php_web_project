<?php
    $table = $_GET["table"];
    $scale = 4;	// 글 목록보기에서 한 화면에 표시되는 글 수

    switch($table) {
        case "_notice" : $board_title = "공지 게시판";
                break;
        case "_youtube" : $board_title = "YOUTUBE 게시판";
                break;
        case "_qna": $board_title = "QNA 게시판";
                break;                      
    }
?>