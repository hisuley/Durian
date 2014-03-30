CREATE TABLE users(
  id int primary key auto_increment,
  username char(255) not null unique,
  password char(255) not null,
  create_time int not null,
  update_time int not null
)

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


CREATE TABLE visa_order(
   id int primary key auto_increment,
   status char(30) not null,
   country char(20) not null,
   type char(20) not null,
   predict_date int not null,
   amount tinyint(2) not null,
   price decimal(10,2) not null,
   depart_date TIMESTAMP not null,
   source char(20) not null,
   contact_name char(60) not null,
   contact_phone char(100) not null,
   contact_address char(200) not null,
   memo text not null,
   material text not null,
   is_pay tinyint(1) not null,
   accountant_id int not null,
   pay_cert char(255) not null,
   op_id int not null,
   op_comment text not null,
   op_time int not null,
   sent_id int not null,
   sent_comment text not null,
   sent_time int not null,
   issue_id int not null,
   issue_comment text not null,
   issue_time int not null,
   back_id int not null,
   back_comment int not null,
   back_time int not null,
   user_id int not null,
   create_time int not null
)

CREATE TABLE visa_order_customer(
  id int primary key auto_increment,
  name char(255) not null,
  passport char(255) not null,
  visa_order_id int not null,
  create_time int not null
)

CREATE TABLE address(
  id int primary key auto_increment,
  name char(255) not null,
  notes text not null,
  parent_id int not null,
  is_enabled tinyint(1) not null,
  create_time int not null

)


CREATE TABLE order_source(
  id int primary key auto_increment,
  name char(255) not null,
  notes text not null,
  parent_id int not null,
  is_enabled tinyint(1) not null,
  create_time int not null

)


CREATE TABLE visa_type(
  id int primary key auto_increment,
  name char(255) not null,
  notes text not null,
  material text not null,
  country_id int not null,
  predict_date tinyint(2) not null,
  price decimal(10,2) not null,
  is_enabled tinyint(1) not null,
  create_time int not null
)

alter table order_source add(contact_name varchar(255) not null, contact_phone varchar(255) not null, contact_address varchar(255) not null);

CREATE TABLE yutong_visa_goods(
  id int primary key auto_increment,
  author_id int not null,
  country_id int not null,
  type_id int not null,
  workdays char(40) not null,
  market_price decimal(10,2) not null,
  price decimal(10,2) not null,
  valid_period char(80) not null,
  stay_period char(255) not null,
  entry_times char(80) not null,
  need_interview char(40) not null,
  consular_district char(255) not null,
  material text not null,
  update_time int not null,
  create_time int not null,
);

CREATE TABLE yutong_user_address(
  id int primary key auto_increment,
  company_name char(80) not null,
  contact_name char(40) not null,
  contact_phone char(100) not null,
  contact_address char(255) not null,
  update_time int not null,
  create_time int not null,
);

CREATE TABLE yutong_visa_order_info(
  id int primary key auto_increment,
  status char(20) not null,
  goods_id int not null,
  amount smallint not null,
  price decimal(10,2) not null,
  single_price decimal(10,2) not null,
  depart_date date not null,
  group_sn char(100) not null,
  visit_receive bool not null default false,
  comment char(255) not null,
  company_name char(80) not null,
  contact_name char(40) not null,
  contact_address char(255) not null,
  contact_phone char(100) not null,
  user_id int not null,
  create_time int not null,
  op_id int not null,
  op_comment char(255) not null,
  material_id int not null,
  material_comment char(255) not null,
  mverify_id int not null,
  mverify_comment char(255) not null,
  sent_id int not null,
  sent_comment char(255) not null,
  sent_time int not null,
  sent_interview char(255) not null,
  back_id int not null,
  back_comment char(255) not null
);

CREATE TABLE yutong_visa_order_customers(
  id int primary key auto_increment,
  order_id int not null,
  customer_name char(255) not null,
  create_time int not null,
);
