<script>
   function check_input() {
      if (!document.member.pass.value) {
          alert("비밀번호를 입력하세요!");    
          document.member.pass.focus();
          return;
      }
      if (!document.member.pass_confirm.value) {
          alert("비밀번호확인을 입력하세요!");    
          document.member.pass_confirm.focus();
          return;
      }
      if (!document.member.name.value) {
          alert("이름을 입력하세요!");    
          document.member.name.focus();
          return;
      }
      if (!document.member.email.value) {
          alert("이메일 주소를 입력하세요!");    
          document.member.email.focus();
          return;
      }
      if (document.member.pass.value != 
            document.member.pass_confirm.value) {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
          document.member.pass.focus();
          document.member.pass.select();
          return;
      }
      document.member.submit();
   }

   function reset_form() {
      document.member.id.value = "";  
      document.member.pass.value = "";
      document.member.pass_confirm.value = "";
      document.member.name.value = "";
      document.member.email.value = "";
      document.member.id.focus();
      return;
   }
</script>
<?php    
    include "../include/db_connect.php";
    $sql    = "select * from _mem where id='$userid'";
    $result = mysqli_query($con, $sql);
    $row    = mysqli_fetch_assoc($result);

    $pass = $row["pass"];
    $name = $row["name"];
    $email = $row["email"];

    mysqli_close($con);
?>    
<form name="member" action="modify.php?id=<?=$userid?>" method="post">
    <div class="join_form">
		<h2>&nbsp; &nbsp;정보 수정</h2>
    	<ul>
            <li>
                <span class="col1">&nbsp; &nbsp;아이디</span>
                <span class="col2"><?=$userid?></span>                
            </li>
            <li>
                <span class="col1">&nbsp; &nbsp;비밀번호</span>
                <span class="col2"><input type="password" name="pass" value="<?=$pass?>"></span>               
            </li>
            <li>
                <span class="col1">&nbsp; &nbsp;비밀번호 확인</span>
                <span class="col2"><input type="password" name="pass_confirm"></span>               
            </li>            
            <li>
                <span class="col1">&nbsp; &nbsp;이름</span>
                <span class="col2"><input type="text" name="name" value="<?=$name?>"></span>               
            </li>
            <li>
                <span class="col1">&nbsp; &nbsp;이메일</span>
                <span class="col2"><input type="text" name="email" value="<?=$email?>"></span>               
            </li>                        
        </ul>                       
		<ul class="buttons12">
            <div style="width: 55%; height:0px; float: left;">
                <li><button type="button" onclick="check_input()">SAVE</button></li>
            </div>
            <div style="width: 55%; height:0px; float: right;">
                <li><button type="button" onclick="reset_form()">CANCLE</button></li>
            </div>
        </ul>
    </div>   
</form>