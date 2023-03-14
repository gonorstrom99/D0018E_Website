create table orders
(
    Order_id   int auto_increment
        primary key,
    Account_id int                                not null,
    Date       datetime default CURRENT_TIMESTAMP not null,
    constraint Account_id
        foreign key (Account_id) references account (ID)
);

