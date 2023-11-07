-- Datenbank: `chewing_gum`
use chewing_gum;

create table kaugummisorten
(
    `id`        int UNSIGNED auto_increment,
    `name`      varchar(255)  not null,
    `geschmack` int default 0 not null,
    `farbe`     varchar(255)  not null,
    `preis`     int           not null,
    constraint kaugummisorten_pk
        primary key (id)
);
