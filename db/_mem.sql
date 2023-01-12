create table _mem (
    num int not null auto_increment,
    id char(20) not null,
    pass char(20) not null,
    name char(20) not null,
    email char(80),
    regist_day char(20),
    level char(20),
    point int,
    primary key(num)
);
