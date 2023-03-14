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

