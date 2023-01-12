<script>
  	function check_input() {	
      	if (!document.board.subject.value) {	// 제목 체크
          	alert("제목을 입력하세요!");
          	document.board.subject.focus();
          	return;
		}
      	if (!document.board.content.value) {	// 내용 체크
          	alert("내용을 입력하세요!");    
          	document.board.content.focus();
          	return;
      	}
	  
      	document.board.submit();
   	}
</script>
<form name="board" method="post" action="insert.php?table=<?=$table?>"
		enctype="multipart/form-data">
	<div class="board_form">
		<p>NOTICE&ensp;WRITE</p>
		<ul>
			<li>
				<span class="col1">이름 : </span>
				<span class="col2"><?=$username?>
				</span>
			</li>
	    	<li style="margin-top: 0px">
	    		<span class="col3">제목 : </span>
	    		<span class="col4"><input name="subject" type="text"></span>
	    	</li>
            <li class="area" style="margin-top: 58px;">
	    		<span class="col5">내용 :&ensp;</span>
	    		<span class="col6">&ensp;
	    			<textarea name="content"></textarea>
	    		</span>
	    	</li>
			<li style="top: -843px">
			    <span class="col7">첨부 파일</span>
			    <span class="col8"><input type="file" name="upfile"></span>
			</li>			
	    </ul>
	</div>

	<ul class="buttons7">
        <?php
	        if ($userid==="관리자") {
        ?>
		    <li><button type="button" onclick="check_input()">SAVE</button></li>
		<?php
		    }
			$list_url = "index.php?type=list&table=$table";
		?>
    </ul>
</form>
<ul class="buttons8">
    <li><button onclick="location.href='<?=$list_url?>'">LIST</button></li>
</ul>
