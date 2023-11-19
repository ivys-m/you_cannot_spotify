
use you_cannot_spotify;


insert into users (username) values ('fuck');
insert into playlists (name, fk_user_id_created_by) values ('fucks-playlist', 1);
insert into songs (song_path, fk_user_id_uploaded_by) values ('./fuck.mp3', 1);
insert into saved (fk_user_id, fk_playlist_id) values (1, 1);
insert into contains (fk_playlist_id, fk_song_id) values (1, 1);
