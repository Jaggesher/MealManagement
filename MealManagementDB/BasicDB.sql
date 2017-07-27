create table tblgender(
gID varchar(6) primary key);
insert into tblgender values('Male');
insert into tblgender values('Female');
insert into tblgender values('Other');

create table tblst(
stID varchar(8) primary key);
insert into tblst values('manager');
insert into tblst values('member');
insert into tblst values('none');

create table account(
ID int  primary key,
Email varchar(200) unique not null,
Pass varchar(30) not null,
Name varchar(30) not null,
Birth date not null,
Mobile varchar(15) not null,
Gender varchar(6) not null,
Pro varchar(100) not null,
ST varchar(8) not null,
ManagerID int,
foreign key (Gender) references tblgender(gID),
foreign key (ST) references tblst(stID));

alter table account 
add constraint fk_ManagerID
foreign key (ManagerID)
references account(ID);

create table manager(
ID int not null primary key,
Name varchar(22) not null unique,
About varchar(1000) not null,
Fix int not null,
foreign key (ID) references account(ID));

CREATE TABLE reqtype(
Type varchar(10) PRIMARY KEY);
    
INSERT INTO reqtype VALUES("join");
INSERT INTO reqtype VALUES("member");
