<?php
	$num  = $_GET["num"];
	$page  = $_GET["page"];

    include "../include/db_connect.php";
	$sql = "select * from $table where num=$num";	// 레코드 검색
	$result = mysqli_query($con, $sql);			// SQL 명령 실행

	$row = mysqli_fetch_assoc($result);			// 레코드 가져오기

	$id      = $row["id"];						// 아이디
	$name      = $row["name"];					// 이름
	$subject    = $row["subject"];				// 제목
	$regist_day   = $row["regist_day"];			// 작성일
	$content    = $row["content"];				// 내용

	$file_name    = $row["file_name"];
	$file_type    = $row["file_type"];
	$file_copied  = $row["file_copied"];	
?>
<script>
	function ripple_check_input()
	{
		if (!document.ripple_form.ripple_content.value)
		{
			alert("내용을 입력하세요!");
			document.ripple_form.ripple_content.focus();
			return;
		}

		document.ripple_form.submit();
    }

    function ripple_del(href)
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = href;
        }
    }
</script>

<ul class="board_view">
	<p class="title">VIEW</p>
    </br></br></br></br>
	<li class="row1">
		<span class="col1"><b>제목 :</b> <?=$subject?></span>	<!-- 제목 출력 -->
        <span class="col2"><?=$name?> | <?=$regist_day?></span>	<!-- 이름, 작성일 출력 -->
	</li>
</ul>
<ul class="board_view">
    <li2 class="row2">
        <?php
        if($file_name) {
            $file_path = "./data/".$file_copied;
            $file_size = filesize($file_path);

            if ($table!="_youtube")
                echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       	<a href='download.php?num=$num&file_copied=$file_copied&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
        }
        echo $content;
        ?>	 <!-- 내용 출력 -->
    </li2>
    <ul class="buttons9">
        <?php
        $modify_url = "index.php?type=modify_form&table=$table&num=$num&page=$page";
        $delete_url = "delete.php?table=$table&num=$num&page=$page";
        $write_url = "index.php?type=form&table=$table";
        ?>
        <button onclick="location.href='../main/index.php'">LIST</button>
    </ul>
    <?php
    if ($userid==="관리자") {
        ?>
        <div style="width: 30%; height:100px; float: left;">
            <ul class="buttons10">
                <button onclick="location.href='<?=$modify_url?>'">EDIT</button>
            </ul>
        </div>
        <div style="width: 65%; height:100px; float: right;">
            <ul class="buttons11">
                <button onclick="location.href='<?=$delete_url?>'">DELETE</button>
            </ul>
        </div>
        <?php
    }
    ?>
</ul>



