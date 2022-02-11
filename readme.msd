Project name is last_csv_import

Here I tried to import csv file contains employee details to mysql database and also can upload employee details one by one.

I used localhost xampp server to run this project.

http://localhost/last_csv_import/index.php/ is the url that is used to run the project.
 
 Added a employee table where table name is 'members'
 table columns are id(int 5), em_code(varchar 20), em_name (varchar 30), dob (datetime), department (varchar 50), join_date (datetime)

please create table in database 'testing' .

CREATE TABLE `testing`.`members` ( `id` INT(5) NOT NULL AUTO_INCREMENT , `em_name` VARCHAR(30) NOT NULL , `em_code` CHAR(15) NOT NULL , `dob` DATETIME NOT NULL , `department` VARCHAR(50) NOT NULL , `join_date` DATETIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
