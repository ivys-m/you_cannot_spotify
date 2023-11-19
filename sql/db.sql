-- i hate not having trailing commas

drop database if exists you_cannot_spotify;

create database if not exists you_cannot_spotify; 
use you_cannot_spotify;

drop table if exists contains;
drop table if exists saved;
drop table if exists songs;
drop table if exists playlists;
drop table if exists users;

create table if not exists users(
    id int primary key auto_increment not null,
    username varchar(32) not null,
    password varchar(255) not null,
    email varchar(255) not null,
    date_of_creation datetime default current_timestamp not null,
    profile_picture_path varchar(255) default null,
    type varchar(255) default 'standard',
    active bit not null default 1
);

create table if not exists playlists(
    id int primary key auto_increment not null,
    name varchar(255) not null,
    picture_path varchar(255) default null,
    date_of_creation datetime default current_timestamp not null,
    fk_user_id_created_by int not null,
    foreign key (fk_user_id_created_by) references users(id) on delete cascade on update cascade,
    active bit not null default 1
);

create table if not exists songs(
    id int primary key auto_increment not null,
    name varchar(255) not null,
    song_path varchar(255) not null,
    picture_path varchar(255) default null,
    date_of_upload datetime default current_timestamp not null,
    fk_user_id_uploaded_by int not null,
    foreign key (fk_user_id_uploaded_by) references users(id) on delete cascade on update cascade,
    active bit not null default 1
);

create table if not exists saved(
    id int primary key auto_increment not null,
    fk_user_id int not null,
    foreign key (fk_user_id) references users(id) on delete cascade on update cascade,
    fk_playlist_id int not null,
    foreign key (fk_playlist_id) references playlists(id) on delete cascade on update cascade,
    active bit not null default 1
);

create table if not exists contains(
    id int primary key auto_increment not null,
    fk_playlist_id int not null,
    foreign key (fk_playlist_id) references playlists(id) on delete cascade on update cascade,
    fk_song_id int not null,
    foreign key (fk_song_id) references songs(id) on delete cascade on update cascade,
    active bit not null default 1
)
