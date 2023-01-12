create table _youtube (
   num int not null auto_increment,
   id char(20) not null,     
   name char(20) not null,
   subject char(200) not null,
   content text,
   is_html char(1),   
   regist_day char(20),
   file_name char(40),
   file_type char(40),
   file_copied char(40),   
   primary key(num)
);