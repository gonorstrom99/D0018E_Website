create table account
(
  ID       int auto_increment comment 'User id'
    primary key,
  Username varchar(30) not null,
  Password varchar(64) not null,
  constraint username_key
    unique (Username)
);

create index Account_ID_index
  on account (ID);

create table admin
(
  Account_Id int not null
    primary key,
  constraint Admin_Account_Id_uindex
    unique (Account_Id),
  constraint Admin_Account_ID_fk
    foreign key (Account_Id) references account (ID)
      on update cascade on delete cascade
);

create table cookies
(
  Cookie     varchar(64) not null
    primary key,
  Account_id int         not null,
  constraint cookies_account_ID_fk
    foreign key (Account_id) references account (ID)
      on update cascade on delete cascade
);

create table orders
(
  Order_id   int auto_increment
    primary key,
  Account_id int  not null,
  Date       date not null,
  constraint Account_id
    foreign key (Account_id) references account (ID)
);

create table product_table
(
  id       int auto_increment
    primary key,
  title    text                 not null,
  price    float                not null,
  quantity int        default 0 not null,
  active   tinyint(1) default 1 not null
);

create table comment
(
  Product_id int  not null,
  Account_id int  not null,
  Comment    text not null,
  Rating     int  not null,
  primary key (Product_id, Account_id),
  constraint Comment_Account_id_uindex
    unique (Account_id),
  constraint Comment_Account_ID_fk
    foreign key (Account_id) references account (ID)
      on update cascade on delete cascade,
  constraint Comment_product_table_id_fk
    foreign key (Product_id) references product_table (id)
      on update cascade on delete cascade,
  constraint Rating_constraint
    check ((0 < `Rating`) and (`Rating` < 6))
);

create index Comment_Product_id_index
  on comment (Product_id);

create table order_content
(
  Order_id   int           not null,
  Product_id int           not null,
  Quantity   int default 0 not null,
  Price      int default 0 not null,
  primary key (Order_id, Product_id),
  constraint order_content_orders_Order_id_fk
    foreign key (Order_id) references orders (Order_id)
      on update cascade,
  constraint order_content_product_table_id_fk
    foreign key (Product_id) references product_table (id)
      on update cascade
);

create table shopping_cart
(
  Account_id int not null,
  Product_id int not null,
  Quantity   int not null,
  primary key (Account_id, Product_id),
  constraint Shopping_cart_Account_ID_fk
    foreign key (Account_id) references account (ID)
      on update cascade on delete cascade,
  constraint Shopping_cart_product_table_id_fk
    foreign key (Product_id) references product_table (id)
      on update cascade on delete cascade
);

create index Shopping_cart_Account_id_Product_id_index
  on shopping_cart (Account_id, Product_id);

