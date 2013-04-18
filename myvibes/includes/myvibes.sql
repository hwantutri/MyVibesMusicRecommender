
--
-- Estrutura da tabela 'edges'
--

DROP TABLE edges CASCADE;
CREATE TABLE edges (
linked int4,
parentid int4,
userid int4,
childid int4
);

--
-- Creating data for 'edges'
--


--
-- Estrutura da tabela 'elapsed'
--

DROP TABLE elapsed CASCADE;
CREATE TABLE elapsed (
start_time timestamp,
curr_track_length varchar(5),
sid int4,
end_time timestamp,
userid int4
);

--
-- Creating data for 'elapsed'
--

INSERT INTO elapsed VALUES ('1','2','2013-03-10 12:34:12.863671','2013-03-10 12:48:16.353425','3:59');

--
-- Estrutura da tabela 'friendreq'
--

DROP TABLE friendreq CASCADE;
CREATE TABLE friendreq (
sender varchar(50),
receiver varchar(50),
reqid int4,
id int4 NOT NULL DEFAULT nextval('friendreq_id_seq'::regclass)
);

--
-- Creating data for 'friendreq'
--



--
-- Creating index for 'friendreq'
--

ALTER TABLE ONLY  friendreq  ADD CONSTRAINT  friendreq_pkey  PRIMARY KEY  (id);

--
-- Estrutura da tabela 'friends'
--

DROP TABLE friends CASCADE;
CREATE TABLE friends (
description varchar(150),
username varchar(50),
lastname varchar(50),
country varchar(50),
firstname varchar(50),
userid int4
);

--
-- Creating data for 'friends'
--

INSERT INTO friends VALUES ('2','s','s','desc','phil','user');
INSERT INTO friends VALUES ('2','a','a','desc','c','a');

--
-- Estrutura da tabela 'friends_pr'
--

DROP TABLE friends_pr CASCADE;
CREATE TABLE friends_pr (
pagerank numeric,
sid int4,
userid int4
);

--
-- Creating data for 'friends_pr'
--

INSERT INTO friends_pr VALUES ('2','1','0.28783469329699');
INSERT INTO friends_pr VALUES ('2','2','0.32081878065266');
INSERT INTO friends_pr VALUES ('2','3','0.23738843556767');
INSERT INTO friends_pr VALUES ('2','4','0.15395809048268');

--
-- Estrutura da tabela 'global_pr'
--

DROP TABLE global_pr CASCADE;
CREATE TABLE global_pr (
pagerank numeric,
sid int4
);

--
-- Creating data for 'global_pr'
--

INSERT INTO global_pr VALUES ('1','0.25');
INSERT INTO global_pr VALUES ('2','0.25');
INSERT INTO global_pr VALUES ('3','0.25');
INSERT INTO global_pr VALUES ('4','0.25');

--
-- Estrutura da tabela 'last_played'
--

DROP TABLE last_played CASCADE;
CREATE TABLE last_played (
date_time timestamp,
last_child int4,
sid int4,
userid int4
);

--
-- Creating data for 'last_played'
--

INSERT INTO last_played VALUES ('1','1','0','2013-03-19 09:13:14.552263');

--
-- Estrutura da tabela 'profile'
--

DROP TABLE profile CASCADE;
CREATE TABLE profile (
description varchar(150),
firstname varchar(50),
country varchar(50),
lastname varchar(50),
emailaddress varchar(50),
username varchar(50),
gender varchar(10),
userid int4
);

--
-- Creating data for 'profile'
--


--
-- Estrutura da tabela 'songs'
--

DROP TABLE songs CASCADE;
CREATE TABLE songs (
genre varchar(255),
year varchar(255),
artist varchar(255),
album varchar(255),
sid int4 NOT NULL DEFAULT nextval('songs_sid_seq'::regclass),
title varchar(255)
);

--
-- Creating data for 'songs'
--

INSERT INTO songs VALUES ('1','title','artist','album','genre','year');
INSERT INTO songs VALUES ('2','title2','artist2','album','genre','year');
INSERT INTO songs VALUES ('3','title3','artist3','album','genre ','year');
INSERT INTO songs VALUES ('4','title4','artist4','album','genre','year');


--
-- Creating index for 'songs'
--

ALTER TABLE ONLY  songs  ADD CONSTRAINT  songspkey  PRIMARY KEY  (sid);

--
-- Estrutura da tabela 'timeline'
--

DROP TABLE timeline CASCADE;
CREATE TABLE timeline (
id int4 NOT NULL DEFAULT nextval('timeline_id_seq'::regclass),
tweet varchar(150),
dt timestamp,
userid int4
);

--
-- Creating data for 'timeline'
--


--
-- Estrutura da tabela 'user_pr'
--

DROP TABLE user_pr CASCADE;
CREATE TABLE user_pr (
pagerank numeric,
sid int4,
userid int4
);

--
-- Creating data for 'user_pr'
--

INSERT INTO user_pr VALUES ('1','1','0.25');
INSERT INTO user_pr VALUES ('1','2','0.25');
INSERT INTO user_pr VALUES ('1','3','0.25');
INSERT INTO user_pr VALUES ('1','4','0.25');

--
-- Estrutura da tabela 'user_top_songs'
--

DROP TABLE user_top_songs CASCADE;
CREATE TABLE user_top_songs (
top_songs varchar(255),
userid int4
);

--
-- Creating data for 'user_top_songs'
--


--
-- Estrutura da tabela 'userprof'
--

DROP TABLE userprof CASCADE;
CREATE TABLE userprof (
password varchar(50),
username varchar(50),
userid int4 NOT NULL DEFAULT nextval('userprof_userid_seq'::regclass)
);

--
-- Creating data for 'userprof'
--

INSERT INTO userprof VALUES ('1','user','password');
INSERT INTO userprof VALUES ('2','s','s');
INSERT INTO userprof VALUES ('3','a','a');


--
-- Creating index for 'userprof'
--

ALTER TABLE ONLY  userprof  ADD CONSTRAINT  userprof_pkey  PRIMARY KEY  (userid);


--
-- Creating relacionships for 'edges'
--

ALTER TABLE ONLY edges ADD CONSTRAINT edge2_id_fkey FOREIGN KEY (userid) REFERENCES songs(sid);

--
-- Creating relacionships for 'edges'
--

ALTER TABLE ONLY edges ADD CONSTRAINT edge_id_fkey FOREIGN KEY (childid) REFERENCES songs(sid);

--
-- Creating relacionships for 'edges'
--

ALTER TABLE ONLY edges ADD CONSTRAINT edges1_id_fkey FOREIGN KEY (childid) REFERENCES songs(sid);

--
-- Creating relacionships for 'edges'
--

ALTER TABLE ONLY edges ADD CONSTRAINT edges2_id_fkey FOREIGN KEY (userid) REFERENCES userprof(userid);

--
-- Creating relacionships for 'edges'
--

ALTER TABLE ONLY edges ADD CONSTRAINT edges_id_fkey FOREIGN KEY (parentid) REFERENCES songs(sid);

--
-- Creating relacionships for 'edges'
--

ALTER TABLE ONLY edges ADD CONSTRAINT timeline_id_fkey FOREIGN KEY (parentid) REFERENCES songs(sid);

--
-- Creating relacionships for 'friends'
--

ALTER TABLE ONLY friends ADD CONSTRAINT friends_id_fkey FOREIGN KEY (userid) REFERENCES userprof(userid);

--
-- Creating relacionships for 'friends_pr'
--

ALTER TABLE ONLY friends_pr ADD CONSTRAINT edge2_id_fkey FOREIGN KEY (userid) REFERENCES userprof(userid);

--
-- Creating relacionships for 'friends_pr'
--

ALTER TABLE ONLY friends_pr ADD CONSTRAINT fpr_id_fkey FOREIGN KEY (sid) REFERENCES songs(sid);

--
-- Creating relacionships for 'global_pr'
--

ALTER TABLE ONLY global_pr ADD CONSTRAINT edge2_id_fkey FOREIGN KEY (sid) REFERENCES songs(sid);

--
-- Creating relacionships for 'last_played'
--

ALTER TABLE ONLY last_played ADD CONSTRAINT timeline_id_fkey FOREIGN KEY (userid) REFERENCES userprof(userid);

--
-- Creating relacionships for 'profile'
--

ALTER TABLE ONLY profile ADD CONSTRAINT profile_id_fkey FOREIGN KEY (userid) REFERENCES userprof(userid);

--
-- Creating relacionships for 'timeline'
--

ALTER TABLE ONLY timeline ADD CONSTRAINT timeline_id_fkey FOREIGN KEY (userid) REFERENCES userprof(userid);

--
-- Creating relacionships for 'user_pr'
--

ALTER TABLE ONLY user_pr ADD CONSTRAINT edge2_id_fkey FOREIGN KEY (userid) REFERENCES userprof(userid);

--
-- Creating relacionships for 'user_top_songs'
--

ALTER TABLE ONLY user_top_songs ADD CONSTRAINT user_top_songs_id_fkey FOREIGN KEY (userid) REFERENCES userprof(userid);