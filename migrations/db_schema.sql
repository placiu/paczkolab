DROP DATABASE paczkolab;
CREATE DATABASE paczkolab CHARACTER SET utf8 COLLATE utf8_general_ci;

create table Size
(
	id int(11) auto_increment primary key,
	size varchar(2) not null,
	price decimal(10,2) not null
);

create table Address
(
	id int(11) auto_increment primary key,
	city varchar(50) not null,
	code varchar(6) not null,
	street varchar(50) not null,
	flat varchar(10) not null
);

create table User
(
	id int(11) auto_increment primary key,
	name varchar(50) not null,
	surname varchar(50) not null,
	credits int(11) not null,
	address_id int(11) not null,
	foreign key (address_id) references Address(id) on delete cascade
);

create table Parcel
(
	id int(11) auto_increment primary key,
	user_id int(11) not null,
	size_id int(11) not null,
	address_id int(11) not null,
	foreign key (user_id) references User(id) on update cascade on delete cascade,
	foreign key (size_id) references Size(id) on update cascade on delete cascade,
	foreign key (address_id) references Address(id) on update cascade on delete cascade
);

