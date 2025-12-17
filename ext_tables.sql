CREATE TABLE tt_address (
    tx_extbase_type varchar(255) DEFAULT '' NOT NULL,
    logo int(11) unsigned DEFAULT '0',
    opening_hours int(11) unsigned NOT NULL DEFAULT '0',
    link varchar(255) DEFAULT '' NOT NULL,
);

CREATE TABLE tx_hhttaddressplaces_domain_model_periodoftime (
    parentid int(11) DEFAULT '0' NOT NULL,
    parenttable varchar(255) DEFAULT '' NOT NULL,

    title varchar(255) NOT NULL DEFAULT '',
    closed int(11) NOT NULL DEFAULT 0,

    open_monday time DEFAULT NULL,
    close_monday time DEFAULT NULL,
    open_monday2 time DEFAULT NULL,
    close_monday2 time DEFAULT NULL,
    appointment_monday int(11) NOT NULL DEFAULT 0,

    open_tuesday time DEFAULT NULL,
    close_tuesday time DEFAULT NULL,
    open_tuesday2 time DEFAULT NULL,
    close_tuesday2 time DEFAULT NULL,
    appointment_tuesday int(11) NOT NULL DEFAULT 0,

    open_wednesday time DEFAULT NULL,
    close_wednesday time DEFAULT NULL,
    open_wednesday2 time DEFAULT NULL,
    close_wednesday2 time DEFAULT NULL,
    appointment_wednesday int(11) NOT NULL DEFAULT 0,

    open_thursday time DEFAULT NULL,
    close_thursday time DEFAULT NULL,
    open_thursday2 time DEFAULT NULL,
    close_thursday2 time DEFAULT NULL,
    appointment_thursday int(11) NOT NULL DEFAULT 0,

    open_friday time DEFAULT NULL,
    close_friday time DEFAULT NULL,
    open_friday2 time DEFAULT NULL,
    close_friday2 time DEFAULT NULL,
    appointment_friday int(11) NOT NULL DEFAULT 0,

    open_saturday time DEFAULT NULL,
    close_saturday time DEFAULT NULL,
    open_saturday2 time DEFAULT NULL,
    close_saturday2 time DEFAULT NULL,
    appointment_saturday int(11) NOT NULL DEFAULT 0,

    open_sunday time DEFAULT NULL,
    close_sunday time DEFAULT NULL,
    open_sunday2 time DEFAULT NULL,
    close_sunday2 time DEFAULT NULL,
    appointment_sunday int(11) NOT NULL DEFAULT 0,

    closed_from_date int(11) NOT NULL DEFAULT 0,
    closed_to_date int(11) NOT NULL DEFAULT 0,
    valid_for varchar(255) NOT NULL DEFAULT '',
);
