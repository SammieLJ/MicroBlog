# MicroBlog 2011
This is web application with MySQL DB. This was written in PHP 5.2 and uses no PHP frameworks.

# This microblog was not localised from Slovene.

# How to install
- Find the file "ConfigDB.php" located in root of microblog installation folder in
- "/ Microblog-demo / classes / Microblog / Config". 
Open "ConfigDB.php" file and edit:
- DbAddress = 'localhost' usually it is set localhost, set your mysql server address;
- DbUsername = 'root', a username for accessing mysql;
- DbPassword = 'root', password to access mysql;
- DbDatabase = 'microblog', enter database in mysql, where we can run sql script microblog-demo.sql;

-- You can run both sql scripts microblog-demo.sql or frontend-demo.sql

Now we set the address in the web browser at: http: //localhost/microblog-demo/index.php (localhost is our local server, it can be any) and a login window will appear. Enter 'demo' for both username and password. You will have admin rights. Change accordingly. I suggest to turn it off.