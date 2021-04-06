## what is my project ?

Hi guys.

i wanna implement a scientific market.

this is my workflow :

1. admin create new product
2. user chooses our product and send his signal file and requested time for product delivery
3. admin accept user request and send his date and price to user and wait for payment
4. user accept product price and delivery date, do success payment
5. admin send final product file
6. user can access final file and use it

## how i'll implement this project ?

#### back end :

this project don't use any framework and my purpose is learning PHP language.
i just use PHP and mysql

#### front end

i just use :

- scss for css
- bootstrap
- jquery

this project is actually simple project, without any framework !
but i'll update this project with Laravel, react, scss later :)

### requirements

- php8
- mysql
- composer
- phpunit

## Steps taken

- implement MVC architecture file structure
- implement [Models](/src/php/Model)
- implement [Controllers](/src/php/Controller)
- write unit test for all controller methods in [Test](/Test) directory
- implement admin panel:

  - every admin has a permission for changing other admins

    1. read access

       - he just can see other admins

    2. write access

       - he can do CRUD

    3. no access
       - he can't even access to admin panel, he just can manage its own users and products

  - admin panel features:
    - create new product
    - delete products
    - see sent signal files from users and accept their prices and dates
    - see all finished stage products that user do payment

unfortunately i haven't done implement user panel yet.
i'm so sorry!
this project dreadfully has dirty code! i will improve it.

i hope that i'll implement users panel tonight :)

if you interested in my project and find a bug or problem please create issue or send pull request.
