-- Datenbank: `chewing_gum`
use chewing_gum;

create table kaugummisorten
(
    `id`        int UNSIGNED auto_increment,
    `name`      varchar(255)  not null,
    `taste` int default 0 not null,
    `color`     varchar(255)  not null,
    `price`     int           not null,
    constraint kaugummisorten_pk
        primary key (id)
);
