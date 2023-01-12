<script>
   function check_input() {
      if (!document.member.id.value) {
          alert("아이디를 입력하세요!");    
          document.member.id.focus();
          return;
      }
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
      if (document.member.pass.value != document.member.pass_confirm.value) {
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
   function check_id() {
     window.open("check_id.php?id=" + document.member.id.value,
         "IDcheck",
          "left=700,top=300,width=380,height=160,scrollbars=no,resizable=yes");
   }
</script>
<form name="member" action="insert.php" method="post">
    <div class="join_form">
		<h2>&nbsp; &nbsp;회원 가입</h2>
    	<ul>
            <li>
                <span class="col1">&nbsp; &nbsp;아이디</span>
                <span class="col2"><input type="text" name="id"></span>
                <span class="col3"><button type="button" onclick="check_id()">중복체크</button></span>                    
            </li>
            <li>
                <span class="col1">&nbsp; &nbsp;비밀번호</span>
                <span class="col2"><input type="password" name="pass"></span>               
            </li>
            <li>
                <span class="col1">&nbsp; &nbsp;비밀번호 확인</span>
                <span class="col2"><input type="password" name="pass_confirm"></span>               
            </li>            
            <li>
                <span class="col1">&nbsp; &nbsp;이름</span>
                <span class="col2"><input type="text" name="name"></span>               
            </li>
            <li>
                <span class="col1">&nbsp; &nbsp;이메일</span>
                <span class="col2"><input type="text" name="email"></span>               
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