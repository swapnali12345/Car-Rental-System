# Car-Rental-System <br>
Working Demo : https://rentalcarservices.000webhostapp.com/ <br>
Use the test card details from the following link: https://www.paypalobjects.com/en_GB/vhelp/paypalmanager_help/credit_card_numbers.htm <br>

Abstract—Nowadays travel by car is on increase and people do that by renting cars. Therefore, for a business to succeed and efficient a user-friendly online car rental system solution is a must. This paper presents a novel car rental system solution design and implementation that can be used to change the car rental industry. Six stages of lifecycle development methodology were followed including Planning, Analysis, Design, Implementation, Testing and Maintenance. Programming Languages used were PHP, HTML, CSS and database of MySQL. This novel approach will increase time efficiency and will save paper cost for business operating in this area. 
Keywords—Car Rental System; Online; Management Information system

I.	INTRODUCTION
With the advances in car rental industry it is very important to have a Management Information Systems (MIS) that can efficiently work on car rentals. It will serve the purpose as two-fold one for customers that can easily rent car online without the need to be physically present at the business location as well as for business managers that can easily update inventory, track current car rentals, generate reports and for viewing feedback as well as for other business operations. In this project we provide an online car rental system which is a web-based system for renting out cars and allowing customers to make online reservations about their services. This system will make sure the transactions are carried out digitally and stored in databases thus minimizing human error. New system is efficient in providing payment and management information via online devices from anywhere across the world and it also monitors transactions and information of customers in a more transparent way.

II.	BACKGROUND
Currently it can be seen that many customers do visit car rental business locations for scheduling and booking car rentals or calling by phone. This is time consuming and involves more cost accumulation for customers as well as businesses as they need to manually store the details, print physical copy of receipts as well as for other operations. This points us to create an online car rental system that is more efficient, accessible, user friendly which in turn can save money for customers as well as for business. The proposal for the new system is such that 
•	The new system is totally online and computerized system. 
•	The new system should provide features like car details, reservation, pdf receipts, user profiles and feedback to the business.
•	This system provides reporting capabilities for business managers. 

III.	METHODOLOGY
The method to build the car rental system was followed in Six stages.Six phase development methodology approach is very beneficial and it helps to keep the process streamlined and avoid any redundancy costs. 
 
A.	Planning
The first phase of this project is planning which is regarded as very important stage. Based on the background research we know the current issues that car rental industry suffers from which is the core problem. The plan is to provide an online car rental system designed especially for small, large and premium car rental business. The car rental system should provide complete functionality of listing and booking a car.

B.	Analysis
Based on the proposed plan data analysis was needed. We looked up the open source databases available and found one on Kaggle. This data set contains car features and includes information such as make, model, year, category and many more other information etc.

C.	Design
For this project several design studies were done and they are helpful in implementation and other phase

1) Data Flow Diagram (DFD): Data Flow Diagram represent various modules and the flow of data needed in the project. As can be seen modules are Booking management, Customer management, System User management, Car management, Payment management Login management
 
2) ER Diagram: Entity–relationship Model describes the structure of a database with the help of a diagram, which is known as Entity Relationship Diagram (ERD). An ER model is a design or blueprint of a database that can later be implemented as a database. As can be seen that for our car rental system we have two main users of system Admin and User. For our database implementation we have various attributes. For customers we have various attributes like username, password, first name, last name, phone etc. We have various relationship like User creating accounting, exploring cars making reservation and giving feedback. Admin can attend users and receive feedback and view various reports.

3) System Flowcharts: This flowchart outlines the flow of data and information for our car rental system. We have two main flowcharts one for Admin which is used to add car details, update information, generate reports, manage inventory etc. and other is for Users who can create new accounts, rent a car, make payments, manage bookings and view billing pdf receipts. 

D.	Implementation
The next phase is the implementation. Based on research we have found HTML/CSS/PHP to be the best combination of front-end programming language and MySQL as database. 
•	PHP: PHP is a popular general-purpose scripting language that is especially suited to web development. PHP application can be run on various platforms. A quick loading website is always appreciated by many individuals. PHP makes it possible to quickly load website and fetch data from server databases.
•	MySQL: We have used MySQL database because of various advantages. MySQL is renowned for being the most secure and reliable database management system used in popular web applications. MySQL features a distinct storage-engine framework that facilitates system administrators to configure the MySQL database server for a flawless performance. MySQL provides features like complete atomic, consistent, isolated, durable transaction support; multi-version transaction support; and unrestricted row-level locking.
The project deals with various implementation of modules as follows:

1)Home Page: The Homepage is the default page of our car rental system. We have a central top Navbar and on left side we do have a sign up and login hyperlinks.  New User needs to create a new accout by sign up page and if he has an account he can just login. Explore pge shows the availability of cars that can be selected and Reserve page enables a user to book a car. Admin can also login to the system by homepage and they can view the transaction history and reports.
 
2)NavBar: The navbar is the main display bar that has hyperlinks for various other webpages.
The implementation code for is as follows this is same used across all pages.

<div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="explore.php">Explore</a></li>
        <li><a href="reserve.php">Reserve</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>

3)Account Creation:New Users need to create account by signup page.

Using input tag the customer information is stored and passed on to the database as can be seen a the code for storage of first name and last name.

<!-- First Name -->
<div class="form-group">
    <label class="col-lg-4 control-label">First Name</label>
    <div class="col-lg-4 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input  name="fname" placeholder="First Name" class="form-control"  type="text">
        </div>
    </div>
</div>

<!-- Last Name -->
<div class="form-group">
    <label class="col-lg-4 control-label">Last Name</label>
    <div class="col-lg-4 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input  name="lname" placeholder="Last Name" class="form-control"  type="text">
        </div>
    </div>
</div>

4)Reservation:Car information is displayed in explore page and User can see the car that are available and based on that user can reserve the car.

5)PDF Recipt: To make a successful reservation credit card information is required. we have used an javascript validation library to validate the credit card information. After that pdf receipt is generated we have used a TCPDF library which is a vastly used open source PHP library for generating PDF documents.

6)Feedback: After a sucessful rental by a user he has the option to give feedback to the business and the business manager can view the feedback to see if any changes are required in business operations. The feedback also provides a custom test box for user comments.
 

Database implementation: Based on the ERD diagram the car rental sytem will need various tables created for proper working. They are as follows
Customers:
•	 Customer ID, name, address, DOB, email, license number are entered in front end form and stored.
Vehicles:
•	 It stores all the details of vehicle like vehicle VIN, make, model, year, license plate, type ID, status ID.
Reservation:
•	Reservation data will be stored here. It includes reservation ID, pick up date, drop off date, rental length, estimate total, VIN, status ID, insurance ID. 
Status:
•	This table includes status of a vehicle like status ID and status description. Description gives information whether the vehicle is available, rented, under maintenance or cancelled.
Insurance:
•	 This table stores insurance information to be taken by customer. This has insurance ID, name and daily cost.
Transaction:
•	Includes payment details of customers. This table has transaction id, fee ID, tax, total amount, transaction date and CC number.

E.	Testing
Before the system is launched the program should be free from errors. We need this type of tests to validate car rental system works correctly and is error free.


F.	Maintenance
Online car rental system is easy to maintain. We use MySQL database that is easy to maintain because of ACID properties and will keep data safe.

IV.	RESULTS
After the online car rental system is deployed, we can see successful results and transactions getting updated into the database.

1.Customer: We can see successful customer transactions created on database. Each customer is assigned a unique Customer ID as well as we store name, address, DOB, email, license and password.


2.Reservation: We can see successful reservation transactions created on database. The total amount is calculated and stored in as well as other details like date range, vin and customer id

3.Admin Reports: We can see the reporting functionality correctly working and we have different reports based on type of card as well as detail reports that show the transactions.

 
V.	CONCLUSION
With online car rental system, it will help to improve the time efficiency of booking and renting the car. Users from anywhere can view and book a car. The online car rental system will save lot of costs and money by getting rid of paper transactions as everything is stored in Database as well as online PDF receipts. We can see minimal errors as everything is computerized and online. Thus, to conclude Online car rental system provides a good opportunity for businesses to go paperless saving costs, time and money.

VI.	FUTURE WORK
The existing system can be expanded to create Android app that everyone prefers nowadays. The car rental system can be expanded to include Rewards/Loyalty points such as to increase the customers. Small companies should make use of this system to publish their services in a wide range and help the company to manage their service more effectively.
