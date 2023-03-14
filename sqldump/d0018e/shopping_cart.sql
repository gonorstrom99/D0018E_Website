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

