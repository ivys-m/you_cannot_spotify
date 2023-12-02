use you_cannot_spotify;
/* pwd: homuhomu */
insert into users (username, password, email, profile_picture_path, type) values ('kaname madoka', 'd91c306b65d7a74c5d74ca4cbe1f5ea3', 'madoka@god.com', 'db/users/profile_pictures/test_picture.png', 'standard');
/* pwd: madomado */
insert into users (username, password, email, profile_picture_path, type) values ('akemi homura', '9a9935af1d3c2742c9d38dc12cbff353', 'homura@akuma.com', 'db/users/profile_pictures/test_picture.png',  'standard');

insert into songs (name, song_path, picture_path, fk_user_id_uploaded_by) values ('watashi dake yuurei', 'db/songs/audio/Watashi Dake Yuurei.mp3', 'db/songs/pictures/Watashi Dake Yuurei.png', 1);

insert into playlists (name, picture_path, fk_user_id_created_by) values ('first-playlist', 'db/playlists/pictures/first-playlist.png', 1);
insert into contains (fk_playlist_id, fk_song_id) values (1, 1);

insert into playlists (name, picture_path, fk_user_id_created_by) values ('second-playlist', 'db/playlists/pictures/first-playlist.png', 1);
insert into contains (fk_playlist_id, fk_song_id) values (1, 1);

insert into saved (fk_user_id, fk_playlist_id) values (1, 1);
insert into saved (fk_user_id, fk_playlist_id) value (1, 2);
insert into saved (fk_user_id, fk_playlist_id) values (2, 1);
