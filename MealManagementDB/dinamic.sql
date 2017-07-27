
-- Member
create table chat(ID)(
MsgID int AUTO_INCREMENT primary key,
ID int not null,
Msg varchar(105) not null,
Dat Date not null,
FOREIGN KEY (ID) REFERENCES account(ID));

create table bal(ID)(
Dat date primary key,
Amount int not null);


-- Manager
create table ntc(ID)(
NtcID int AUTO_INCREMENT primary key,
Gdate date not null,
Msg varchar(1500) not null,
Till date not null);



CREATE TABLE member(ID)(
    ID int PRIMARY KEY,
    Type varchar(10) not null,
    Meal Float not null,
    FOREIGN KEY (ID) REFERENCES account(ID),
    FOREIGN KEY (Type) REFERENCES reqtype(Type)
);
create table mealdate(ID)(
ID int primary key,
Mdate date not null unique,
Amount Float not null);

CREATE TABLE meal(ID)(
    ID int PRIMARY KEY,
    FOREIGN KEY(ID) REFERENCES mealdate(ID)(ID));--one ID have general meaning..

CREATE table ext(ID)(
    Dat date primary key,
    Amount Float not null)

-- qury
insert INTO meal VALUES();
ALTER TABLE tablename ADD new_col_name Float NOT NULL DEFAULT 0;


SELECT mealdate2.ID as ID, mealdate2.Mdate as Dat ,mealdate2.Amount as rate,meal2.A1 as meal
from mealdate2
INNER JOIN meal2
ON mealdate2.ID=meal2.ID