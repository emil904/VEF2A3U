drop database if exists 2310952929_PictureBase;
create database 2310952929_PictureBase;
use 2310952929_PictureBase;

create table categories 
(
  categoryID int(11) not null auto_increment,
  categoryName varchar(45) default null,
  constraint category_PK primary key(categoryID),
  constraint categoryname_NQ unique(categoryName)
);

create table images 
(
  imageID int(11) not null auto_increment,
  imageName varchar(45) default null,
  imagePath varchar(255) not null,
  imageText varchar(155) default null,
  categoryID int(11) default null,
  constraint image_PH primary key(imageID),
  constraint image_category_FK foreign key(categoryID) references categories (categoryID)
);

create table Users 
(
  userID int(11) not null auto_increment,
  firstName varchar(55) not null,
  lastName varchar(55) not null,
  userEmail varchar(125) not null,
  userName varchar(15) not null,
  userPassword varchar(15) not null,
  accessLevel tinyint default 1,									-- Hvað má notandinn sjá/gera. TD: 1 = alm notandi. 2 = súperjúser.  3 = admin
  activity bit default 1,											--  er notandinn virkur/óvirkur?
  constraint user_PK primary key(userID),
  constraint username_NQ unique(userName),				-- notandanafn er einkvæmt í þessum DB
  constraint useremail_NQ unique(userEmail)				-- netfang er einkvæmt líka
);

delimiter $$
create procedure NewCategory(category_name varchar(45))
begin
	insert into Categories(categoryName)values(category_name); 
end$$
delimiter ;


delimiter $$
create procedure GetCategory(category_id int)
begin
	declare numberOfImages int;
    
    select count(categoryID) into numberOfImages from Images where categoryID = category_id;
	select categoryID,categoryName,numberOfImages from Categories where categoryID = category_id;
end$$
delimiter ;


delimiter $$
create procedure CategoryList()
begin
	select categoryID, categoryName from Categories order by categoryName;
end$$
delimiter ;


delimiter $$
create procedure UpdateCategory(category_name varchar(45), category_id int)
begin
	update Categories set categoryName = category_name 
	where categoryID = category_id;
end$$
delimiter ;


delimiter $$
create procedure DeleteCategory(category_id int)
begin
	if not exists(select categoryID from Images where categoryID = category_id) then
		delete from categories where categoryID = category_id;
	end if;
end$$
delimiter ;


delimiter $$
create procedure NewImage(image_name varchar(45),image_path varchar(255),image_text varchar(155),category_id int)
begin
	insert into Images(imageName,imagePath,imageText,categoryID)
    values(image_name,image_path,image_text,category_id);
end$$
delimiter ;


delimiter $$
create procedure GetImage(image_id int)
begin
	select I.imageID,I.imageName,I.imagePath,I.imageText,C.categoryName
    from Images I
    inner join Categories C on I.categoryID = C.categoryID
    and I.imageID = image_id;
end$$
delimiter ;


delimiter $$
create procedure ImageList()
begin
	select I.imageID,I.imageName,C.categoryName
    from Images I
    inner join Categories C on I.categoryID = C.categoryID;
end$$
delimiter ;


delimiter $$
create procedure UpdateImage(
	image_id int,
    image_name varchar(45),
    image_path varchar(255),
    image_text varchar(155),
    category_id int
)
begin
	update Images set imageName = image_name, imagePath = image_path, imageText = image_text, categoryID = category_id
    where imageID = image_id;
end$$
delimiter ;


delimiter $$
create procedure DeleteImage(image_id int)
begin
	delete from Images where imageID = image_id;
end$$
delimiter ;


-- function sem validerar notandann sem loggar sig inn með notandanafni og lykilorði.
-- Í þetta skipti er ekki gert ráð fyrir dulkóðun á lykilorðinu en það kemur seinna :-)
delimiter $$
drop function if exists ValidateUser $$

create function ValidateUser(user_name varchar(15),user_pass varchar(15)) 
returns int
begin
	if exists(select userID from Users where userName = user_name and userPassword = user_pass and activity = 1) then
		return 1;
	else
		return 0;
	end if;
end $$
delimiter ;


-- Stored Procedure sem nýskráir notanda í gagnagrunninn(PictureBase)
-- Athugið að accessLevel er ekki settur hér.  Hann verður sjálfkrafa 1
delimiter $$
drop procedure if exists NewUser $$

create procedure NewUser
(
	first_name varchar(55),
	last_name varchar(55),
    user_email varchar(125),
    user_name varchar(15),
    user_password varchar(15)
)
begin
	insert into Users(firstName,lastName,userEmail,userName,userPassword)
	values(first_name,last_name,user_email,user_name,user_password);
end $$
delimiter ;


-- Stored Procedure sem sækir upplýsingar um ákveðinn notanda(án lykilorðs)
delimiter $$
drop procedure if exists GetUser $$

create procedure GetUser(user_id int)
begin
	select userID,firstName,lastName,userEmail,userName,accessLevel
    from Users
    where userID = user_id and activity = 1;
end $$
delimiter ;


-- Stored Procedure sem listar út alla users í PictureBase grunninum
delimiter $$
drop procedure if exists UserList $$

create procedure UserList()
begin
	select userID,firstName,lastName,userName
    from Users where activity = 1;
end $$
delimiter ;


-- Stored Procedure sem uppfærir upplýsingar um ákv. notanda
delimiter $$
drop procedure if exists UpdateUser $$

create procedure UpdateUser
(
	user_id int,
	first_name varchar(55),
	last_name varchar(55),
    user_email varchar(125),
    user_name varchar(15),
    user_password varchar(15)
)
begin
	update Users 
    set firstName = first_name,lastName = last_name,userEmail = user_email,userName = user_name,userPassword = user_password
	where userId = user_id and activity = 1;
end $$
delimiter ;


-- Stored Procedure sem "eyðir" notanda.
-- Í raun er activity notandans sett á 0 en upplýsingum um hann er ekki eytt úr grunninum
delimiter $$
drop procedure if exists DeleteUser $$

create procedure DeleteUser(user_id int)
begin
	update Users set activity = 0 where userId = user_id;
end $$
delimiter ;


-- Ef notanda hefur verið "eytt" en vill "snúa aftur" þá er þesi WSP keyrður.
-- Hér er activity einfaldlega sett á 1 fyrir viðkomandi notanda.
delimiter $$
drop procedure if exists ResetUser $$

create procedure ResetUser(user_id int)
begin
	update Users set activity = 1 where userId = user_id;
end $$
delimiter ;


-- Function sem setur access level a notanda.  Aðeins sá sem er með admin réttindi( al = 3)
-- getur breytt þessum upplýsingum.
-- function skilar access level notandans; gamla gildinu er skilað ef uppgefið admin_id hefur
-- ekk accessLevel 3
delimiter $$
drop function if exists SetAccessLevel $$

create function SetAccessLevel(access_level tinyint,user_id int,admin_id int)
returns int
begin
	if(select accessLevel from Users where userID = admin_id) = 3 then
		update Users set accessLevel = access_level where userID = user_id and activity = 1;
        return access_level;
	else
		return(select accessLevel from Users where userID = user_id and activity = 1);
	end if;
end $$
delimiter ;


-- ============================================== Testgögn ============================================== --
-- setjum default admin með hefðbundinni insert skipun
insert into Users(firstName,lastName,userEmail,userName,userPassword,accessLevel)
values('Konráð','Valsson','konnichiva@picturebase.xxx','konni59','Y7B62Dr0jJ',3);

-- setjum notendur í grunninn með því að kalla á Steored Procedure NewUser()
call NewUser('Jón','Jónsson','nonni@fakemail.ru','nonni666','Jr78dK23A');
call NewUser('Hafrún','Ólafsdóttir','go@somewhere.vg','haffy55','Sp09W3nNz');
call NewUser('Anna','Káradóttir','annsy@fakemail.us','annakarXXX','Al04Jut6');
call NewUser('Pétur','Hannesson','pethan@syphil.is','pjotr',')nHg65FtT');
call NewUser('Hjördís','Orradóttir','sweetheart@fakemail.dk','disaskvisa','JB5Uy68F');
call NewUser('Friðrik','Hlynsson','fridrik.hlynsson@fh.ru','frikki45','MvR45Ij6');
call NewUser('Margrét','Benediktsdóttir','maggaben@some.jp19','greta','Ew9I87gY');
call NewUser('Gunnar','Magnússon','gunnarm@','gunzo009','OwY765Gp');
call NewUser('Margrét','Jónsdóttir','magga@awesome.no','dottirmin99','T4is8E9L');
call NewUser('Pétur','Davíðsson','rokkari@grunge.gr','fhrokkar17','K7Yt41zF');
-- ============================================== oo0000oo ============================================== --