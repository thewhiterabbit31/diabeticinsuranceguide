/*DDL*/

CREATE TABLE IF NOT EXISTS all_plans(
plan_id int(11) AUTO_INCREMENT PRIMARY KEY,
provider varchar(50) NOT NULL,
tier varchar(30) NOT NULL,
price FLOAT,
update_date date NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS insulin_plans(
provider varchar(50) NOT NULL REFERENCES all_plans(provider),
tier varchar(30) NOT NULL REFERENCES all_plans(tier),
slow_act_insulin varchar(30) NOT NULL,
fast_act_insulin varchar(30) NOT NULL,
insulin_type varchar(15) NOT NULL,
update_date date NOT NULL,

PRIMARY KEY (provider, tier, slow_act_insulin, fast_act_insulin, insulin_type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS pill_plans(
provider varchar(50) NOT NULL REFERENCES all_plans(provider),
tier varchar(30) NOT NULL REFERENCES all_plans(tier),
pill VARCHAR(30) NOT NULL,
update_date date NOT NULL,

PRIMARY KEY (provider, tier, pill)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS users(
email varchar(50) PRIMARY KEY,
pw varchar(50) NOT NULL,
diabetesType tinyint(1) NOT NULL,
slow_act_insulin varchar(30),
fast_act_insulin varchar(30),
insulin_type VARCHAR(30),
pill varchar(30),
subscribe tinyint(1) NOT NULL
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



CREATE TABLE IF NOT EXISTS user_plans(
user_id int(11) REFERENCES users(email),
plan_id int(30) REFERENCES all_plans(plan_id),
date_served date NOT NULL,
PRIMARY KEY(user_id, plan_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*DML*/
INSERT INTO insulin_plans
  VALUES('BlueCross BlueShield', 'Bronze', 'Detemir', 'Lispro (Humalog)', 'Vials/Syringes', '2018-01-01');

INSERT INTO insulin_plans
  VALUES('BlueCross BlueShield', 'Silver', 'Detemir', 'Lispro (Humalog)', 'Pens/Tips', '2018-01-01');

INSERT INTO pill_plans
  VALUES('BlueCross BlueShield', 'Bronze', 'Biguanides', '2018-01-01');

INSERT INTO pill_plans
  VALUES('BlueCross BlueShield', 'Bronze', 'Metformin (Glucophage)', '2018-01-01');

INSERT INTO pill_plans VALUES ('Etna Group', 'Bronze', 'Biguanides', '2018-01-01');

INSERT INTO users
  VALUES ('admin@admin', 'admin', 2, 'Glargine', 'Lispro (Humalog)', 'Pump', NULL , 1);


INSERT INTO all_plans
  VALUES (NULL, 'BlueCross BlueShield', 'Bronze', NULL, NULL);

INSERT INTO all_plans
  VALUES (NULL, 'BlueCross BlueShield', 'Silver', NULL, NULL);

INSERT INTO all_plans
  VALUES (NULL, 'BlueCross BlueShield', 'Gold ', NULL, NULL);

INSERT INTO all_plans
  VALUES (NULL, 'Etna Group', 'Silver', NULL, NULL);

INSERT INTO all_plans
  VALUES (NULL, 'Etna Group', 'Platinum', NULL, NULL);

INSERT INTO all_plans
  VALUES (NULL, 'United Health', 'Gold ', NULL, NULL);

INSERT INTO all_plans
  VALUES (NULL, 'United Health', 'Silver', NULL, NULL);

INSERT INTO all_plans
  VALUES (NULL, 'United Health', 'Platinum', NULL, NULL);




