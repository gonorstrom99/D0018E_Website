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

