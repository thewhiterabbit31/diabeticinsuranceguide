CREATE TABLE IF NOT EXISTS plans(
plan_id int(11) AUTO_INCREMENT PRIMARY KEY,
provider varchar(50) NOT NULL,
tier varchar(30) NOT NULL,
slow_act_insulin varchar(30) NOT NULL,
fast_act_insulin varchar(30) NOT NULL,
insulin_type varchar(15) NOT NULL,
date_served date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS users(
username varchar(30) PRIMARY KEY,
email varchar(50),
birthday date,
type1 tinyint(1) NOT NULL,
type2 tinyint(1) NOT NULL,
subscribe tinyint(1) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS pens(
user_id int(11) REFERENCES users(username),
pen_size double NOT NULL,
pen_gauge double NOT NULL,
date_served date NOT NULL,
PRIMARY KEY(user_id, date_served)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS pumps(
user_id int(11) REFERENCES users(username),
provider varchar(30) NOT NULL,
date_served date NOT NULL,
PRIMARY KEY(user_id, date_served)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS syringes(
user_id int(11) REFERENCES users(username),
syringe_size double NOT NULL,
syringe_gauge double NOT NULL,
syringe_volume double NOT NULL,
date_served date NOT NULL,
PRIMARY KEY(user_id, date_served)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS pills(
user_id int(11) REFERENCES users(username),
pill_name double NOT NULL,
date_served date NOT NULL,
PRIMARY KEY(user_id, date_served)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO 'plans'(plan_id, provider, tier, slow_act_insulin, fast_act_insulin, insulin_type) VALUES ('BlueCross BlueShield', 'gold', )


INSERT INTO 'users' (username, email, birthday, type1, type2) VALUES ('admin', NULL, NULL, '1', '0');
