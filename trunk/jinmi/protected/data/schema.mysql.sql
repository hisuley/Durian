CREATE TABLE users(
  id int primary key auto_increment,
  username char(255) not null unique,
  realname char(255) not null,
  password char(255) not null,
  role char(255) not null,
  qq char(40) not null,
  status char(40) not null,
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


CREATE TABLE panel_bank_account(
  id int primary key auto_increment,
  `name` char(80) not null,
  status char(80) not null,
  card_holder char(80) not null,
  account_number char(255) not null,
  account_agency char(80) not null,
  memo char(255) not null,
  init_money decimal(10,2) not null,
  balance decimal(10,2) not null,
  create_time int not null,
  update_time int not null
);

CREATE TABLE panel_bank_account_history(
  id int primary key auto_increment,
  `value` decimal(10,2) not null,
  account_id int not null,
  target_id int not null,
  direction char(20) not null,
  memo char(255) not null,
  balance decimal(10,2) not null,
  create_time int not null,
  update_time int not null
);

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
   agency_id int not null,
   type char(20) not null,
   predict_date int not null,
   amount tinyint(2) not null,
   total_price decimal(10,2) not null,
   price decimal(10,2) not null,
   cost_price decimal(10,2) not null,
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
   is_pay_out tinyint not null,
   need_pay_out_amount decimal(10,2) not null,
   pay_out_amount decimal(10,2) not null,
   pay_out_accountant_id int not null,
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
);

CREATE TABLE panel_finance_records(
  id INT PRIMARY KEY AUTO_INCREMENT,
  `handler` INT NOT NULL,
  reviewer INT NOT NULL,
  transaction_value DECIMAL(10,2) NOT NULL,
  charge_account_id int not null,
  charge_record_id int not null,
  direction CHAR(20) NOT NULL,
  pay_file char(255) not null,
  pay_file2 char(255) not null,
  pay_file3 char(255) not null,
  pay_file4 char(255) not null,
  pay_file5 char(255) not null,
  memo TEXT NOT NULL,
  STATUS CHAR(40) NOT NULL,
  `type` CHAR(20) NOT NULL,
  create_time INT NOT NULL,
  update_time INT NOT NULL
);

CREATE TABLE panel_finance_cancel_request(
  id INT PRIMARY KEY AUTO_INCREMENT,
  `type` char(20) not null,
  status char(40) not null,
  applicant_id int not null,
  charge_account_id int not null,
  charge_record_id int not null,
  direction CHAR(20) NOT NULL,
  finance_id int not null,
  transaction_value decimal(10,2) not null,
  approver_id int not null,
  approved_comment char(255) not null,
  approved_time int not null,
  create_time INT NOT NULL
);

CREATE TABLE panel_finance_items(
  id INT PRIMARY KEY AUTO_INCREMENT,
  order_id INT NOT NULL,
  vid INT NOT NULL,
  transaction_value DECIMAL(10,2) NOT NULL,
  direction CHAR(20) NOT NULL,
  memo TEXT NOT NULL,
  STATUS CHAR(40) NOT NULL,
  `type` CHAR(20) NOT NULL,
  create_time INT NOT NULL,
  update_time INT NOT NULL
);

CREATE TABLE panel_finance_reviews(
  id INT PRIMARY KEY AUTO_INCREMENT,
  order_id INT NOT NULL,
  handler_id INT NOT NULL,
  opinion char(20) not null,
  transaction_value DECIMAL(10,2) NOT NULL,
  direction CHAR(20) NOT NULL,
  memo TEXT NOT NULL,
  STATUS CHAR(40) NOT NULL,
  `type` CHAR(20) NOT NULL,
  create_time INT NOT NULL,
  update_time INT NOT NULL
);


CREATE TABLE panel_message(
  id INT PRIMARY KEY AUTO_INCREMENT,
  `type` char(40) not null,
  from_user int not null DEFAULT 0,
  to_user int not null,
  is_read tinyint(1) not null,
  `title` char(255) not null,
  content text not null,
  link char(255) not null,
  create_time INT NOT NULL
);




CREATE TABLE visa_order_customer(
  id int primary key auto_increment,
  name char(255) not null,
  passport char(255) not null,
  agency_id int not null,
  status char(40) not null,
  price decimal(10,2) not null,
  cost_price decimal(10,2) not null,
  is_pay tinyint(1) not null,
  is_pay_out tinyint(1) not null,
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
  source_id int not null,
  create_time int not null
);

CREATE TABLE visa_type_agency(
  id int primary key auto_increment,
  type_id int not null,
  agency_id int not null,
  price decimal(10,2) not null,
  notes text not null,
  material text not null,
  predict_date char(10) not null,
  is_enabled tinyint(1) not null,
  show_order tinyint(1) not null,
  create_time int not null
);

alter table order_source add(contact_name varchar(255) not null, contact_phone varchar(255) not null, contact_address varchar(255) not null);

CREATE TABLE order_source_account(
  id int primary key auto_increment,
  account_holder char(80) not null,
  account_bank char(255) not null,
  account_number char(255) not null,
  order_source_id int not null,
  update_time int not null,
  create_time int not null
);

CREATE TABLE yutong_configs(
    id int primary key auto_increment,
    meta_name char(255) not null,
    meta_value text not null,
    parent_id int not null,
    create_time int not null
);

CREATE TABLE yutong_visa_goods(
  id int primary key auto_increment,
  status char(20) not null,
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
  show_order tinyint(1) not null default 0,
  update_time int not null,
  create_time int not null
);

CREATE TABLE yutong_user_address(
  id int primary key auto_increment,
  user_id int not null,
  company_name char(80) not null,
  contact_name char(40) not null,
  contact_phone char(100) not null,
  contact_address char(255) not null,
  contact_qq char(255) not null,
  contact_email char(255) not null,
  contact_sex char(10) not null,
  contact_province char(50) not null,
  contact_handler int not null,
  update_time int not null,
  create_time int not null
);

CREATE TABLE yutong_visa_order_info(
  id int primary key auto_increment,
  is_pay tinyint not null,
  pay_file char(255) not null,
  accountant_time int not null,
  accountant_id int not null,
  accountant_handler int not null,
  accountant_comment char(255) not null,
  agency_id int not null,
  status char(20) not null,
  goods_id int not null,
  amount smallint not null,
  price decimal(10,2) not null,
  single_price decimal(10,2) not null,
  depart_date date not null,
  group_sn char(100) not null,
  visit_receive bool not null default false,
  comment char(255) not null,
  backstage_comment char(255) not null,
  company_name char(80) not null,
  contact_name char(40) not null,
  contact_address char(255) not null,
  contact_phone char(100) not null,
  user_id int not null,
  op_id int not null,
  op_comment char(255) not null,
  op_time int not null,
  material_id int not null,
  material_comment char(255) not null,
  material_time int not null,
  mverify_id int not null,
  mverify_comment char(255) not null,
  mverify_time int not null,
  mverify_resubmit char(255) not null,
  sent_id int not null,
  sent_comment char(255) not null,
  sent_time int not null,
  sent_out_time int not null,
  sent_predict_time date not null,
  sent_interview char(255) not null,
  back_id int not null,
  back_comment char(255) not null,
  back_time int not null,
  delivery_id int not null,
  delivery_comment char(255) not null,
  delivery_time int not null,
  follow_id int not null,
  update_time int not null,
  create_time int not null
);

CREATE TABLE yutong_visa_order_customers(
  id int primary key auto_increment,
  order_id int not null,
  customer_name char(255) not null,
  passport char(255) not null,
  create_time int not null
);

CREATE TABLE yutong_visa_goods_attachment(
  id int primary key auto_increment,
  goods_id int not null,
  attachment_title char(80) not null,
  attachment_desc char(255) not null,
  attachment_url char(255) not null,
  create_time int not null
);


CREATE TABLE yutong_visa_article(
  id int primary key auto_increment,
  title char(255) not null,
  content text not null,
  tags char(255) not null,
  related_country_id int not null,
  user_id int not null,
  update_user int not null,
  update_time int not null,
  create_time int not null
);


ALTER TABLE yutong_visa_order_info ADD delivery_id int not null;
ALTER TABLE yutong_visa_order_info ADD delivery_comment char(255) not null;
ALTER TABLE yutong_visa_order_info ADD delivery_time int not null;