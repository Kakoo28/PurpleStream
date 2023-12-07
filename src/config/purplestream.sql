/*==============================================================*/
/* Table : anime                                                */
/*==============================================================*/
create table anime
(
   anime_id             int not null auto_increment,
   language_id          int not null,
   anime_name           varchar(100),
   anime_description    text,
   anime_image          varchar(255),
   primary key (anime_id)
);

/*==============================================================*/
/* Table : anime_episode                                        */
/*==============================================================*/
create table anime_episode
(
   anime_episodeid      int not null auto_increment,
   season_id            int not null,
   epiosde_name         varchar(100) not null,
   episode_mp4          longtext not null,
   primary key (anime_episodeid)
);

/*==============================================================*/
/* Table : anime_season                                         */
/*==============================================================*/
create table anime_season
(
   season_id            int not null auto_increment,
   anime_id             int not null,
   season_name          varchar(30) not null,
   primary key (season_id)
);

/*==============================================================*/
/* Table : anim_cat                                             */
/*==============================================================*/
create table anim_cat
(
   anime_id             int not null,
   category_id          int not null,
   primary key (anime_id, category_id)
);

/*==============================================================*/
/* Table : category                                             */
/*==============================================================*/
create table category
(
   category_id          int not null auto_increment,
   category_name        varchar(30),
   primary key (category_id)
);

/*==============================================================*/
/* Table : langage                                              */
/*==============================================================*/
create table langage
(
   language_id          int not null auto_increment,
   langage_name         varchar(50) not null,
   primary key (language_id)
);

/*==============================================================*/
/* Table : users                                                */
/*==============================================================*/
create table users
(
   user_id              int not null auto_increment,
   user_email           varchar(100),
   user_name            varchar(30),
   user_password        varchar(255),
   user_role            int not null DEFAULT 0,
   primary key (user_id)
);

/*==============================================================*/
/* Table : users_profiles                                       */
/*==============================================================*/
create table users_profiles
(
   user_profileid       int not null auto_increment,
   user_id              int not null,
   user_profilname      varchar(10),
   user_image           varchar(200),
   primary key (user_profileid)
);

alter table anime add constraint fk_traduire foreign key (language_id)
      references langage (language_id) on delete restrict on update restrict;

alter table anime_episode add constraint fk_avoir foreign key (season_id)
      references anime_season (season_id) on delete restrict on update restrict;

alter table anime_season add constraint fk_diviser foreign key (anime_id)
      references anime (anime_id) on delete restrict on update restrict;

alter table anim_cat add constraint fk_correspondre foreign key (anime_id)
      references anime (anime_id) on delete restrict on update restrict;

alter table anim_cat add constraint fk_correspondre2 foreign key (category_id)
      references category (category_id) on delete restrict on update restrict;

alter table users_profiles add constraint fk_regrouper foreign key (user_id)
      references users (user_id) on delete restrict on update restrict;