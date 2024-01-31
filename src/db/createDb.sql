drop database if exists vostdb;
create database vostdb;
use vostdb;

drop table if exists users;
create table users
(
    id_user  int unique          not null auto_increment primary key,
    name     varchar(255) unique not null,
    email    varchar(255) unique not null,
    password varchar(255)        not null,
    is_active boolean not null default(false)
);

drop table if exists vinyls;
create table vinyls
(
    id_vinyl     int unique   not null auto_increment primary key,
    name         varchar(255) unique,
    stock        int          not null,
    price        int          not null,
    style        varchar(255),
    duration     int          not null,
    max_duration int          not null
);

drop table if exists songs;
create table songs
(
    id_song    int unique          not null auto_increment primary key,
    name       varchar(255) unique not null,
    artist     varchar(255)        not null,
    compositor varchar(255)        not null,
    genre      varchar(255)        not null,
    duration   int                 not null
);

drop table if exists address;
create table address
(
    id_address  int unique   not null auto_increment primary key,
    postal_code int          not null,
    city        varchar(255) not null,
    street      varchar(255) not null,
    number      varchar(255) not null,
    id_user     int          not null,
    constraint foreign key (id_user) references users (id_user)
);

drop table if exists orders;
create table orders
(
    id_order   int unique not null auto_increment primary key,
    date_time  datetime   not null,
    id_address int        not null,
    constraint foreign key (id_address) references address (id_address)
);

drop table if exists has_songs;
create table has_songs
(
    id_vinyl int not null,
    id_song  int not null,
    constraint foreign key (id_vinyl) references vinyls (id_vinyl),
    constraint foreign key (id_song) references songs (id_song),
    primary key (id_song, id_vinyl)
);

drop table if exists vinyls_ordered;
create table vinyls_ordered
(
    id_vinyl int not null,
    id_order int not null,
    number   int not null,
    constraint foreign key (id_vinyl) references vinyls (id_vinyl),
    constraint foreign key (id_order) references orders (id_order),
    primary key (id_order, id_vinyl)
);

