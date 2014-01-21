CREATE TABLE users{
  id int primary key auto_increment,
  username char(255) not null unique,
  password char(255) not null,
  create_time int not null,
  update_time int not null
}

CREATE TABLE orders_info{
  id int primary key auto_increment,
  status char(255) not null,
  pay_status tinyint(1) not null DEFAULT 0,
  create_time int not null,
  update_time int not null
}


CREATE TABLE orders_goods{
  id int primary key auto_increment,
  create_time int not null,
  update_time int not null
}

CREATE TABLE order_info_attr{
  id int primary key auto_increment,
  attr_id int not null,
  value text not null,
  create_time int not null,
  update_time int not null
}

CREATE TABLE order_attributes{
  id int primary key auto_increment,
  name char(255) not null,
  type tinyint(1) not null COMMENT '0/disabled(use default value) 1/input 2/radio 3/select 4/checkbox 5/textarea',
  create_time int not null,
  update_time int not null
}

CREATE TABLE finance_account{
  id int primary key auto_increment,
  money decimal(10,2) not null,
  order_id int not null,
  comment char(255) not null,
  create_time int not null
}