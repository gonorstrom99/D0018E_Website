create table comment
(
    Product_id int                                not null,
    Account_id int                                not null,
    Comment    text                               not null,
    Rating     int                                not null,
    datetime   datetime default CURRENT_TIMESTAMP not null,
    primary key (Product_id, Account_id),
    constraint Comment_product_table_id_fk
        foreign key (Product_id) references product_table (id)
            on update cascade on delete cascade,
    constraint comment_account_ID_fk
        foreign key (Account_id) references account (ID)
            on update cascade on delete cascade,
    constraint Rating_constraint
        check ((0 < `Rating`) and (`Rating` < 6))
);

create index Comment_Product_id_index
    on comment (Product_id);

