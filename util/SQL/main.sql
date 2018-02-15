CREATE SCHEMA court_db;

create table `case`
(
  case_id INT UNSIGNED auto_increment
  primary key,
  description LONGTEXT not null,
  time_created TIMESTAMP default CURRENT_TIMESTAMP null
)
;

create table jury
(
  jury_id INT UNSIGNED auto_increment
  primary key,
  jury_name VARCHAR(64) not null,
  jury_mail VARCHAR(64) not null
)
;

create table jury_opinions
(
  opinion_id INT UNSIGNED auto_increment
  primary key,
  jury_id INT UNSIGNED null,
  case_id INT UNSIGNED null,
  opinion VARCHAR(64) default 'Нет ответа' not null,
  md5 VARCHAR(64) null,
  isOpen SMALLINT(5) default 1 not null,
  constraint jury_opinions_jury_jury_id_fk
  foreign key (jury_id) references jury(jury_id),
  constraint jury_opinions_case_case_id_fk
  foreign key (case_id) references `case`(case_id)
)
;




DROP TRIGGER IF EXISTS court_db.inser_empty_opinions;
CREATE TRIGGER court_db.inser_empty_opinions AFTER INSERT  ON court_db.`case`
FOR EACH ROW
  INSERT INTO jury_opinions(jury_id, case_id, md5) SELECT jury_id, NEW.case_id, MD5(CONCAT(jury_mail,NEW.case_id)) FROM jury;

CREATE USER 'jury'@'%' IDENTIFIED BY 'juryjury';
GRANT ALL PRIVILEGES ON court_db.* TO 'jury'@'%';
ALTER TABLE jury_opinions DROP FOREIGN KEY jury_opinions_jury_jury_id_fk;
ALTER TABLE jury_opinions
  ADD CONSTRAINT jury_opinions_jury_jury_id_fk
FOREIGN KEY (jury_id) REFERENCES jury (jury_id) ON DELETE CASCADE;
ALTER TABLE jury_opinions DROP FOREIGN KEY jury_opinions_case_case_id_fk;
ALTER TABLE jury_opinions
  ADD CONSTRAINT jury_opinions_case_case_id_fk
FOREIGN KEY (case_id) REFERENCES `case` (case_id) ON DELETE CASCADE;
ALTER TABLE jury_opinions ADD datetime TIMESTAMP NULL;