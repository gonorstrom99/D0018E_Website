create table cookies
(
    Cookie     varchar(64) not null
        primary key,
    Account_id int         not null,
    constraint cookies_account_ID_fk
        foreign key (Account_id) references account (ID)
            on update cascade on delete cascade
);

