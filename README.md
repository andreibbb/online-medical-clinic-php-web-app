<br/>
<p align="center">
  <a href="https://github.com/andreibbb/online-medical-clinic-php-web-app">
    <img src="https://i.imgur.com/GRkz5wK.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">Online Medical Clinic Web App</h3>

  <p align="center">
    This is my project, it is created from my desire to advance my knowledge of the PHP language, the PHP framework CodeIgniter, and also for the other technologies used in the project. The project is what a modern online medical clinic might look like. The web application is created 100% in the Romanian language.
    <br/>
    <br/>
    <a href="https://github.com/andreibbb/online-medical-clinic-php-web-app"><strong>Explore the docs »</strong></a>
    <br/>
    <br/>
  </p>
</p>

![Downloads](https://img.shields.io/github/downloads/andreibbb/online-medical-clinic-php-web-app/total) ![Stargazers](https://img.shields.io/github/stars/andreibbb/online-medical-clinic-php-web-app?style=social) ![License](https://img.shields.io/github/license/andreibbb/online-medical-clinic-php-web-app) 

## Table Of Contents

* [About the Project](#about-the-project)
* [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
* [License](#license)
* [Authors](#authors)
* [Acknowledgements](#acknowledgements)

## About The Project

![Screen Shot](https://i.imgur.com/7CqPLDq.png)

Specifically, the project is the official website of a medical clinic, where users and administrators of the website can use certain features to facilitate customer steps, such as creating an appointment on a given day for a certain doctor.

Some functionalities of the project:
* Register new accounts, login into existing ones, and forgot password function
* A normal user has a profile page that can be edited, can change their email, can log out of their account, can search for a doctor, can create an appointment on a certain day at the desired doctor.
* The doctor can write details about the diagnosis and other remarks during the check directly on the scheduling page that can be seen by the user who created the schedule. The doctor can see all the appointments he has as a calendar.
* The administrator has an administration panel, where he can approve or cancel an appointment, and search for a user by name, email, or phone number.

## Built With

* HTML / CSS / Bootstrap
* PHP
* CodeIgniter Framework
* MySQL database
* Javascript

## Getting Started

This is a personal project made especially for increase my knowledge and represents a online medical clinic website. 

### Prerequisites

Before running the website on your server you should create a database and restore the database using this [file](https://github.com/andreibbb/online-medical-clinic-php-web-app/blob/main/db_requirments_backup.sql), so your database tables will be restored and now your website just need data filling from that tables.

### Installation

1. Restore the database using the file I talked about above.

2. Clone the repo

```sh
git clone https://github.com/andreibbb/online-medical-clinic-php-web-app.git
```

3. Configure ```/application/config/config.php``` file with an SMTP server for forgotten passwords, email changes, and some other functions.

4. Enter your database credentials into the ```/application/config/database.php``` file.

5, Enter on the website.

## License

Distributed under the MIT License. See [LICENSE](https://github.com/andreibbb/online-medical-clinic-php-web-app/blob/main/LICENSE.md) for more information.
