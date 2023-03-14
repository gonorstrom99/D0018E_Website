create table product_table
(
    id          int auto_increment
        primary key,
    title       text                 not null,
    price       float                not null,
    quantity    int        default 0 not null,
    active      tinyint(1) default 1 not null,
    description text                 null,
    author      text                 not null
);

