<div id="top"></div>
<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/phonist/Office-Management-System">
    <img src="https://github.com/phonist/Office-Management-System/blob/master/public/assets/admin/img/logo-large.png" alt="Logo" width="80" height="80">
  </a>

<h3 align="center">Office Management System</h3>

  <p align="center">
    Various features that are required for office management system.
  </p>
</div>

<!-- ABOUT THE PROJECT -->
## About The Project

![Dashboard](https://raw.githubusercontent.com/phonist/Office-Management-System/master/public/assets/Dashboard.png?raw=true)

The project acts as a startup template for an office management system.



Dashboard summarizes and visualizes some information of the system. Meanwhile, it also provides a way to access its corresponding feature.

Apart from the dashboard, users can create an account by Facebook, Google, Github or by using their own email address.



To let users create accounts on Facebook, Google, Github,

A developer has to make sure a third-party API is working properly by assigning the correct API key in .env file.



The key to Facebook, Google, and Github is listed in .env file as below:
```
FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=
FACEBOOK_REDIRECT_URL=

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URL=

GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
GITHUB_REDIRECT_URL=
```
### Built With
* [Laravel](https://laravel.com)
* [Bootstrap](https://getbootstrap.com)
* [JQuery](https://jquery.com)


<!-- GETTING STARTED -->
## Getting Started
This project was developed under Docker environment. So please make sure Docker is installed.
To configure the docker environment. Please check docker-compose.yml and Dockerfile.
The project is using LEMP stack.

After project setup is done, please open your browser, navigate to localhost:80 and login with default credentials.

admin@byteoffice.com

password: 123qwe

### Prerequisites
* Docker
* Composer
* NodeJS (optional) for Yarn


### Installation
1. git clone https://github.com/phonist/Office-Management-System.git
2. composer install
3. yarn install
4. docker-compose up -d --build
5. cp .env.example .env

6. change the .env file to your own database credentials
```
e.g
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=oms
DB_USERNAME=postgres
DB_PASSWORD=postgres
```
7. docker exec oms_app php artisan key:generate
8. docker exec oms_app php artisan migrate --seed



<!-- USAGE EXAMPLES -->
## Usage
The overall features or modules in this projecet are:
- Client
![Client](https://raw.githubusercontent.com/phonist/Office-Management-System/master/public/assets/Client.png)
- Vendor
![Vendor](https://raw.githubusercontent.com/phonist/Office-Management-System/master/public/assets/Vendor.png)
- Invoice
![Invoice](https://raw.githubusercontent.com/phonist/Office-Management-System/master/public/assets/Invoice.png)
- Quotation 
![Quotation](https://raw.githubusercontent.com/phonist/Office-Management-System/master/public/assets/Quotation.png)
- Purchase
![Purchase](https://raw.githubusercontent.com/phonist/Office-Management-System/master/public/assets/Purchase.png)
- Product
![Product](https://raw.githubusercontent.com/phonist/Office-Management-System/master/public/assets/Product.png)
- Employee
![Employee](https://raw.githubusercontent.com/phonist/Office-Management-System/master/public/assets/Employee.png)
- Office Settings
![Office Settings](https://raw.githubusercontent.com/phonist/Office-Management-System/master/public/assets/Office.png)




<!-- ROADMAP -->
## Roadmap

- [x] Client
- [x] Vendor
- [x] Sales
    - [x] Create Invoice
    - [x] All Invoice
    - [x] Processing Order
    - [x] Pending Shipment
    - [x] Delivered Order
    - [x] Quotation
    - [x] All Quotation
- [x] Purchase
    - [x] New Purchase
    - [x] Purchase List
    - [x] Received Product
- [x] Product and Services
    - [x] Product List
    - [x] Import Product
    - [x] Category
    - [x] Withdrawal
- [x] Employee
    - [x] Add Employee
    - [x] Import Employee
    - [x] Employee Employee
    - [x] Terminated Employee
    - [x] Employee Award
    - [x] Set Attendance
    - [x] Import Attendance
    - [x] Attendance Report
    - [x] Application List
    - [x] Reimbursement
- [x] Office Settings
    - [x] Department
    - [x] Job Titles
    - [x] Job Categories
    - [x] Work Shifts
    - [x] Working Days
    - [x] Holiday List
    - [x] Leave Type
    - [x] Pay Grades
    - [x] Salary Component
    - [x] Employement Status
    - [x] Tax
    - [x] Role
    - [ ] Permission




<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement" or "bug".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/<featureName>`)
3. Commit your Changes (`git commit -m 'add <featurename>'`)
4. Push to the Branch (`git push origin feature/<featureName>`)
5. Open a Pull Request




<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE.txt` for more information.




<!-- CONTACT -->
## Contact

Adrian Chong - [@twitter_handle](https://twitter.com/AdrianC50883820) - rujyi94@hotmail.com

Project Link: [https://github.com/phonist/Office-Management-System](https://github.com/phonist/Office-Management-System)
