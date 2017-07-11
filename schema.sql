DROP TABLE users;
CREATE TABLE users(
    user_id integer primary key, 
    email varchar(25), 
    password varchar(25), 
    salt varchar(25),
    name varchar(25) 
);

DROP TABLE bills;
CREATE TABLE bills(
    bill_id integer primary key,
    user_id integer,
    author_id integer,
    amount double,
    due_date date,
    description varchar(25),
    pending integer,
    FOREIGN KEY(user_id) REFERENCES users(user_id)
);

DROP TABLE notifications;
CREATE TABLE notifications(
    notifications_id integer primary key,
    user_id integer,
    description varchar(25),
    notification_date date,
    FOREIGN KEY(user_id) REFERENCES users(user_id)
);