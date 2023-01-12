<?php
	$num  = $_GET["num"];
	$page = $_GET["page"];

    include "../include/db_connect.php";
	$sql = "select * from $table where num=$num";	// 레코드 검색
	$result = mysqli_query($con, $sql);		// SQL 명령 실행

	$row = mysqli_fetch_assoc($result);

	$name    	= $row["name"];			// 이름
	$subject    = $row["subject"];		// 제목
	$content    = $row["content"];		// 내용

	$regist_day = date("Y-m-d (H:i)");  // UTC 기준 현재 '년-월-일 (시:분)'
	$file_name  = $row["file_name"];

	mysqli_close($con);
?>	
<script>
  	function check_input() {		
      	if (!document.board.subject.value) {		// 제목 체크
          	alert("제목을 입력하세요!");
          	document.board.subject.focus();
          	return;
		}
      	if (!document.board.content.value) {		// 내용 체크
          	alert("내용을 입력하세요!");    
          	document.board.content.focus();
          	return;
      	}  
      	document.board.submit();
   	}
</script>
<form name="board" method="post" action="modify.php?table=<?=$table?>&num=<?=$num?>&page=<?=$page?>">
	<div class="board_form">
		<p>NOTICE&ensp;EDIT</p>
		<ul>
			<li>
				<span class="col1">이름 : </span>
				<span class="col2"><?=$name?>
				</span>
			</li>			
	    	<li>
	    		<span class="col3" style="margin-left: 0px">제목 : </span>
	    		<span class="col4"><input name="subject" type="text" value="<?=$subject?>"></span>
	    	</li>
            <li class="area" style="margin-top: 58px;">
	    		<span class="col5" style="margin-left: 7px">내용 : &ensp;</span>
	    		<span class="col6" style="margin-left: -7px">&ensp;
	    			<textarea name="content"><?=$content?></textarea>
	    		</span>
	    	</li>
            <li style="top: -843px">
                <span class="col9"> 첨부 파일 : </span>
			        <span class="col8"><?=$file_name?></span>
			</li>	
	    </ul>
	</div>
	<ul class="buttons7">
		<li><button type="button" onclick="check_input()">SAVE</button></li>
			<?php
				$list_url = "index.php?type=list&table=$table&page=$page";
			?>
    </ul>
    <ul class="buttons8">
		<li><button type="button" onclick="location.href='<?=$list_url?>'">LIST</button></li>
	</ul>
</form>

