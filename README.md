# Automated-day-off-system
A PHP based automated day-off system

[![Built With PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Built With MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)

This system is built usin XAMPP for hosting . Design templates used for the ```root_dashboard.php``` script are in the ```DESIGN_FILES``` can be found here https://colorlib.com/wp/template/fixed-header-table/ .

### Setting Up the simulation
In order to set up the simulation system we need to config the ```[mail function]``` parameter set in the ```php.ini``` file and also the ```[sendmail]``` parameter set in the ```sendmail.ini``` file on your local machine according to your SMTP preferences (I used Gmail for excample). 
Finally you need to change the variable ```$dir``` in the ```new_req.php``` script and set it to the address of your localhost server.
