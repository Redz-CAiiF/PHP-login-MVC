# PHP-login-MVC
A simple web page with a log-in and register page

#Info
- Components -> this folder contains the various component that might be used in the page
- controller -> this folder contains all the files used for the page routing
- css -> this folder contains all the page styles that are not considered a component
- logic -> this folder contains all the application logic (e.g. for the login or the register of a user)
- model -> this folder contains all the Database access methods, im using PDO to access the database
    - in order to change the connection data for your DBMS modify config.ini
- view -> this folder contains all the views of the project (e.g. login.php register.php)
- SQL -> this folder contains all the sql scripts used to create the database where all the users data is stored
>
- .htaccess -> it is used to prettify the various links (e.g. yourPath/loginBootstrapMinimal/register)
- index.php -> the first called page when you open the website

Currently i'm separating the various parts of the code. The final product should be in MVC standard (view, controller, router(MainController used to redirect to all other files), model)
