drop table if exists amzni5_authitem;
drop table if exists amzni5_authitemchild;
drop table if exists amzni5_authassignment;
drop table if exists amzni5_rights;

create table amzni5_authitem
(
   name varchar(64) not null,
   type integer not null,
   description text,
   bizrule text,
   data text,
   primary key (name)
);

create table amzni5_authitemchild
(
   parent varchar(64) not null,
   child varchar(64) not null,
   primary key (parent,child),
   foreign key (parent) references amzni5_authitem (name) on delete cascade on update cascade,
   foreign key (child) references amzni5_authitem (name) on delete cascade on update cascade
);

create table amzni5_authassignment
(
   itemname varchar(64) not null,
   userid varchar(64) not null,
   bizrule text,
   data text,
   primary key (itemname,userid),
   foreign key (itemname) references amzni5_authitem (name) on delete cascade on update cascade
);

create table amzni5_rights
(
	itemname varchar(64) not null,
	type integer not null,
	weight integer not null,
	primary key (itemname),
	foreign key (itemname) references amzni5_authitem (name) on delete cascade on update cascade
);