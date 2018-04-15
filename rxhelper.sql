CREATE TABLE IF NOT EXISTS type1_plans(
plan_id int(11) AUTO_INCREMENT PRIMARY KEY,
provider varchar(50) NOT NULL REFERENCES all_plans(provider),
tier varchar(30) NOT NULL REFERENCES all_plans(tier),
slow_act_insulin varchar(30) NOT NULL,
fast_act_insulin varchar(30) NOT NULL,
insulin_type varchar(15) NOT NULL,
update_date date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS type2_plans(
plan_id int(11) AUTO_INCREMENT PRIMARY KEY,
provider varchar(50) NOT NULL REFERENCES all_plans(provider),
tier varchar(30) NOT NULL REFERENCES all_plans(tier),
pill VARCHAR(30) NOT NULL,
update_date date NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS all_plans(
provider varchar(50) NOT NULL,
tier varchar(30) NOT NULL,
price double,
update_date date NOT NULL,
PRIMARY KEY (provider, tier)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS users(
email varchar(50) PRIMARY KEY,
birthday date,
diabetesType tinyint(1) NOT NULL,
slow_act_insulin varchar(30),
fast_act_insulin varchar(30),

subscribe tinyint(1) NOT NULL,
phoneNum int

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS pens(
user_id int(11) REFERENCES users(email),
pen_size double NOT NULL,
pen_gauge double NOT NULL,
date_served date NOT NULL,
PRIMARY KEY(user_id, date_served)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS pumps(
user_id int(11) REFERENCES users(email),
provider varchar(30) NOT NULL,
date_served date NOT NULL,
PRIMARY KEY(user_id, date_served)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS syringes(
user_id int(11) REFERENCES users(email),
syringe_size double NOT NULL,
syringe_gauge double NOT NULL,
syringe_volume double NOT NULL,
date_served date NOT NULL,
PRIMARY KEY(user_id, date_served)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO type1_plans(provider, tier, slow_act_insulin, fast_act_insulin, insulin_type, update_date)
  VALUES('BlueCross BlueShield', 'Bronze', 'Detemir', 'Lispro (Humalog)', 'Vials/Syringes', '2018-01-01');

INSERT INTO type1_plans(provider, tier, slow_act_insulin, fast_act_insulin, insulin_type, update_date)
  VALUES('BlueCross BlueShield', 'Silver', 'Detemir', 'Lispro (Humalog)', 'Pens/Tips', '2018-01-01');

INSERT INTO type2_plans(provider, tier, pill, update_date)
  VALUES('BlueCross BlueShield', 'Bronze', 'Biguanides', '2018-01-01');

INSERT INTO 'users' (username, email, birthday, type1, type2) VALUES ('admin', NULL, NULL, '1', '0');
