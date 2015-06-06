[![Documentation Status](https://readthedocs.org/projects/usersystem/badge/?version=latest)](http://l.zbee.me/1KPsvcy)
[![Build Status](https://img.shields.io/circleci/project/Zbee/UserSystem.svg?style=flat)](http://l.zbee.me/1ANkrWS)
[![Codacy Badge](https://www.codacy.com/project/badge/a1e608648cd84fafa12ac64c18284c6f)](http://l.zbee.me/1cAI6Oi)
[![Test Coverage](https://codeclimate.com/github/Zbee/UserSystem/badges/coverage.svg)](http://l.zbee.me/1HO3gRX)

Runs with PHP 5.4.0+, and makes use of a MySQL database (5.5.43, 5.6.20 used in
development).

##Installation & Use

After downloading the [archive file](http://l.zbee.me/1MrcEiw) you can add the
`/UserSystem/ ` and `/Example/` directories to your own site and the example
site will work as soon as you update the information in
`/UserSystem/config.php` and run `/UserSystem/setup.php`.

For more detailed information please see the
[documentation](http://l.zbee.me/1KPsvcy).

##Todo
 * ~~Make the database tighter (user blobs are 160 characters, make that column
 160 characters, etc.)~~ and create cascading deletions
 * Made the same database standard inside of tests (preferably without having
 to recreate the databases for each test)
 * Write more tests and make them work for every possible return as well as
 tests trying to dangerous code run or inserted into the database
 * Write documentation for all of the files
 * Split this repository into a stable (master) branch and a development branch

##Features
* 2-step Logins
* User Settings
* Email Verification
* Password Recovery
* Multi-standard compliancy

##Features to come
* reCAPTCHA integration
* More Encryption
* Option to not store passwords
* Ability to login/register with other services

##Security

* The hashing and transfer methods are all FIPS 140-2 Level 2 compliant (adapted
 for software; uses a DoD-approved hashing function, tamper-checking on
 sessions, and removal of possibly tampered-with sessions).

* Uses a system I like to refer to as a blob system, which is basically thus:
 The cookie is simply a very long string (more than a googol of possibilities)
 that is then stored in the database and hard-coded to the user who owns the
 code. Furthermore, all blobs that can be are destroyed after use, and have
 expiration dates.

* Can easily be configured (through the straight-forward configuration file) to
 use an AES-compliant encryption system for IPs that are stored with the user.

* Has a very simple 2Step Authentication system that will delay login of users
 with it activated and require them to follow a link in an email sent to them,
 again utilizing the blob system.

* SSL (https://) connections are supported with no extra configuration.

* The logout file has conventions in place to allow for users to destroy every
 session tied to their account, increasing their ability to keep their own
 accounts as secure as possible.

* Rainbow and Lookup tables are halted in their tracks by use of very secure
 salts which are utilized in the hashing of user's passwords. These salts are
 recreated every time the user changes their password. In addition to that, the
 salts alone have nearly a googol possibilities.

* SQL injection attacks are stopped upfront by sanitizing user input. There's
 also a fall-back with how the PHP and MySQL commands work together, which does
 not allow for multiple SQL queries to take place in the same PHP function,
 disabling an attacker from editing data, grabbing data, or removing data from
 a database.

* The system uses up-to-date methods of communicating with the MySQL server
 (PDO, not mysql_*) keeping with the times and automatically rendering the
 system invulnerable to many old attacks.

##Simplicity

* I've included an example site for every account action necessary, removing any
 strenuous recreation of what a page should have on it.

* It's incredibly simple to fetch and display user information, all you have to
 do is validate the session and the needed data will be returned.

* All of the options for the login system are nicely wrapped up in a simple
 configuration file.

* There is no code you have to create for yourself for the most part, the system
 was created with simplicity in mind.

* The database structure was also created with simplicity in mind, and leaves
 plenty of room for extra doo-dads.

* Stores valuable data that can be used in many other systems and is vital for
 many circumstances. Data such as IPs, one previous password, one previous
 email, the first email, the first username, when they last logged on, when
 they last changed their password, when they last changed their email, and
 more!

##License

Copyright 2014-2015 Ethan Henderson.

[![GPLv3](https://www.gnu.org/graphics/gplv3-127x51.png)](http://l.zbee.me/1SZtWYz)
See the [`COPYING`](http://l.zbee.me/1BN1Y7r) file for the text of this license.
