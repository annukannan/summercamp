# summercamp
Summer Camp Registration Portal
Today Camps are organized in different locations, countries for families to register their kids during school breaks like Spring Break, Winter break and Long Summer breaks. This system will allows parents to search the list of locations where camps are offered, what courses are offered and pick the right choice to register their kids, make payments.  

High Level Architecture of the System
Presentation Tier - UI for the following modules
  User Registration
	User Login
  CRUD Operations for Administrator
	  Course Category
	  Course Location
	  Schedule
	  Course
	  Course Schedule
  End User
	  Registering to the Course
	  Withdrawing from the Course
  Report – Open vs Filled Spots by Course and Course Location(Using Functions)
  Audit on User Actions of Registering and Withdrawing (Using Trigger)
Logic Tier
	Support all functions for the above UI 

Data Tier
	Database
	Storage
 
Presentation tier (HTML)
In n-tier architecture, one of the important tiers that user directly interacts is the Presentation tier which is also commonly known as UI layer or view layer.  This is used to display information related to Camp Registration System where user can search the list of courses available by providing their State or Zip Code details.  This tier communicates with other tiers to pass the information entered by user and get the results that needs to be displayed back to the user.  
Application tier (PHP-Hypertext PreProcessor)
This tier is separated out from the presentation tier that contains the actual business logic(processing the information) where it controls on what information to be used for instructing the data tier to pull the raw data and send the information back to Presentation tier as needed.  In this system, PHP is used and this is a server side scripting language that’s embedded in HTML. 
Data tier (mySQL)
The data tier provides simple access to data stored in persistent storage.  In this system we will use mySQL datastore to store the Camp Registration Data in the entity relationship model (see the ER diagram attached).  


 

