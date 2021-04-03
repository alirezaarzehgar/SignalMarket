-- fake data

SHOW TABLES;

INSERT INTO users (
    username,
    email,
    password
) VALUES (
    'ali',
    'ali@gmail.com',
    md5('1234')
),
(
    'mohammad',
    'mohammad@gmail.com',
    md5('1234')
),
(
    'hamed',
    'hamed@gmail.com',
    md5('1234')
);

SELECT * FROM users;

INSERT INTO admins 
(
    username,
    password,
    permission
) VALUES (
    'ali',
    md5('1234'),
    6
),
(
    'mohammad',
    md5('1234'),
    2
),
(
    'hamed',
    md5('1234'),
    0
),
(
    'hosein',
    md5('1234'),
    2
),
(
    'mehrdad',
    md5('1234'),
    0
),
(
    'farhad',
    md5('1234'),
    6
),
(
    'maryam',
    md5('1234'),
    2
),
(
    'zohre',
    md5('1234'),
    0
),
(
    'layli',
    md5('1234'),
    2
),
(
    'javad',
    md5('1234'),
    6
),
(
    'nazanin',
    md5('1234'),
    2
),
(
    'fateme',
    md5('1234'),
    0
),
(
    'venus',
    md5('1234'),
    2
),
(
    'hadi',
    md5('1234'),
    6
),
(
    'fahime',
    md5('1234'),
    0
),
(
    'ninaz',
    md5('1234'),
    2
),
(
    'shahin',
    md5('1234'),
    6
);

SELECT * FROM admins;


INSERT INTO products (
    admin_name,
    subject,
    photo_dir_path,
    introduction_to_product,

    choosen_by_customer,

    choosen_by_admin,

    success_payment
) VALUES (
    'ali',
    'subject',
    '/path',
    'intro',
    0,
    0,
    0
);

SELECT * FROM products;