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

