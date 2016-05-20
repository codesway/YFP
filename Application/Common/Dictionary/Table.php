CREATE TABLE IF NOT EXISTS `yfp_user` (
  id int unsigned auto_increment primary key,
  username varchar(32) not null default '',
  password char(32) not null default '',
  nickname varchar(32) not null default '',
  email varchar(64) not null default '',
  salt char(8) not null default '',
  create_time int unsigned default 0,
  update_time int unsigned default 0,
  last_login_time int unsigned not null default 0,
  last_login_ip varchar(15) not null default ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
