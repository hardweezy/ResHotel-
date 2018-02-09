Hotel Reservation System using PHP, HTML, CSS and JS
@author Solomon
@version 1.0.3
@year 2016


1. Create a Database
2. Import "reshotelsystem.sql" which can be found in the sqlDump folder into the Database created in Step 1.
3. Change database connection details in "core/init.php" under DB Settings. You can find this file in the sourc_code folder
4. Navigate to URL of extracted file on your web server using web browser.

Contributors
. JQuery
. Bootstrap 3 by Twitter Bootstrap
. MeekroDB by Sergey Tsalkov
. CSRF_Protect by Josep Viciana
. GUMP by Filis
. Password Compact by Anthony Ferrara
. Carbon DateTime by Brian Nesbitt
. DateDropper by Felice Gattuso
. DropZone by Matias Meno
. Nice Select by Hernan Sartorio
. Oh Snap by Justin Domingue
. Pace by Zack Bloom
. Parsley by William Durand
. Images by Unsplash.com


TroubleShooting
1. Having trouble viewing all rooms 'admin/index.php', turn off sql_mode in your MYSQL, probably turned on by default in 5.7.* or Higher
2. Trouble signing in, Clear all cookies and refresh browser.
3. If Signing error persit, create a new account


ToDo
1. Send Reservation details to Guest Email on successful reservation
2. Edit a Room Type details by Admin
3. Edit Room type gallery by Admin
4. Tie Payment Gateway to Rooms bookings
5. Customer Support
6. Check History of a Room type to show who have occupied it in the past.
7. Approve booking by Admin and send notification to Customer
8. Allow customer cancel reservation
9. Extend datatables plugin to draw data from query.
10. Handle Forgotten password
11. Handle Email Validation

Vulnerability
In case of any reported bug. send an email to solomonomokehinde@gmail.com



Folder Structure
  |-admin 			all files used by the Admin Manager
  |-class			all Class files
  |-core			initialization file
  |-includes		some snippet reusable codes
  |-public			assets directory, js,css,images are stored here
  |  |-bootstrap
  |  |  |-dist
  |  |  |  |-css
  |  |  |  |-fonts
  |  |  |  |-js
  |  |  |-fonts
  |  |  |-grunt
  |  |  |-js
  |  |  |-less
  |  |  |  |-mixins
  |  |-css
  |  |  |-dd-icon
  |  |-font-awesome
  |  |  |-css
  |  |  |-fonts
  |  |  |-less
  |  |  |-scss
  |  |-img
  |  |-js
  |  |-plugin
  |  |  |-pointy-slider
  |  |  |  |-css
  |  |  |  |-img
  |  |  |  |-js
  |  |  |  |-partials
  |  |  |  |-scss
  |  |-uploads
  |-test				Demo folder to test some action
  |-vendor				3rd party library files to support the application
  |  |-bin
  |  |-composer
  |  |-ircmaxell
  |  |  |-password-compat
  |  |  |  |-.git
  |  |  |  |  |-branches
  |  |  |  |  |-hooks
  |  |  |  |  |-info
  |  |  |  |  |-logs
  |  |  |  |  |  |-refs
  |  |  |  |  |  |  |-heads
  |  |  |  |  |  |  |-remotes
  |  |  |  |  |  |  |  |-composer
  |  |  |  |  |  |  |  |-origin
  |  |  |  |  |-objects
  |  |  |  |  |  |-info
  |  |  |  |  |  |-pack
  |  |  |  |  |-refs
  |  |  |  |  |  |-heads
  |  |  |  |  |  |-remotes
  |  |  |  |  |  |  |-composer
  |  |  |  |  |  |  |-origin
  |  |  |  |  |  |-tags
  |  |  |  |-lib
  |  |  |  |-test
  |  |  |  |  |-Unit
  |  |-nesbot
  |  |  |-carbon
  |  |  |  |-src
  |  |  |  |  |-Carbon
  |  |  |  |  |  |-Exceptions
  |  |  |  |  |  |-Lang
  |  |-sergeytsalkov
  |  |  |-meekrodb
  |  |  |  |-simpletest
  |  |-symfony
  |  |  |-polyfill-mbstring
  |  |  |  |-Resources
  |  |  |  |  |-unidata
  |  |  |-translation
  |  |  |  |-.git
  |  |  |  |  |-branches
  |  |  |  |  |-hooks
  |  |  |  |  |-info
  |  |  |  |  |-logs
  |  |  |  |  |  |-refs
  |  |  |  |  |  |  |-heads
  |  |  |  |  |  |  |-remotes
  |  |  |  |  |  |  |  |-composer
  |  |  |  |  |  |  |  |-origin
  |  |  |  |  |-objects
  |  |  |  |  |  |-info
  |  |  |  |  |  |-pack
  |  |  |  |  |-refs
  |  |  |  |  |  |-heads
  |  |  |  |  |  |-remotes
  |  |  |  |  |  |  |-composer
  |  |  |  |  |  |  |-origin
  |  |  |  |  |  |-tags
  |  |  |  |-Catalogue
  |  |  |  |-DataCollector
  |  |  |  |-Dumper
  |  |  |  |-Exception
  |  |  |  |-Extractor
  |  |  |  |-Loader
  |  |  |  |  |-schema
  |  |  |  |  |  |-dic
  |  |  |  |  |  |  |-xliff-core
  |  |  |  |-Tests
  |  |  |  |  |-Catalogue
  |  |  |  |  |-DataCollector
  |  |  |  |  |-Dumper
  |  |  |  |  |-fixtures
  |  |  |  |  |  |-resourcebundle
  |  |  |  |  |  |  |-corrupted
  |  |  |  |  |  |  |-dat
  |  |  |  |  |  |  |-res
  |  |  |  |  |-Loader
  |  |  |  |  |-Util
  |  |  |  |  |-Writer
  |  |  |  |-Util
  |  |  |  |-Writer
  |  |-wixel
  |  |  |-gump
  |  |  |  |-examples





