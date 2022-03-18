# WangMai: _Classroom Vacancy Checking and Booking System_

## Objectives

-  Create a system that can help monitor classroom status by IoT sensors.
-  Create a system that can reserve the classroom by the web 
application.

269492 - ISNE Project
A Project Submitted in Partial Fulfillment of Requirements for the Degree of Bachelor of Engineering

## Installation & loading

Clone this git repository

```sh
$ git clone https://github.com/pipoomm/wangmai.git
```

And import database file to your mysql database via phpmyadmin
| Data | Path |
| ------ | ------ |
| WangMai SQL | [datasource/sql_wangmai_eng_.sql][PlGa] |

In `connect.php` specified your database configuration and define API key for communicate with IoT Project Kit board manually:

	<?php
    	$connect = mysqli_connect("HOST", "USERNAME", "PASSWORD", "DB_NAME");
    	$api_key_value = "";
	?>

> Note: Register user account in `signin.php` To using CMUOauth please contact to [ITSC Chiang Mai University](https://oauth.cmu.ac.th/) to get token key first. 

## License

Department of Computer Engineering, Faculty of Engineering, Chiang Mai University

## Publication

Website of this [project](https://wangmai.eng.cmu.ac.th/) can be access by student/staff who only in CMU which have CMU IT Account.

[PlGa]: <https://github.com/pipoomm/wangmai/blob/main/datasource/sql_wangmai_eng_.sql>
