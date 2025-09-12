Git Workflow Process for IAP Unit Project


1. EMAIL VALIDATION FEATURE (Part I)
- git checkout -b feature/email-system
- Created mail/MailHandler.php for email validation and sending
- Created process_signup.php for form processing
- Updated ClassAutoLoad.php to include MailHandler
- Updated forms.php form action
- Updated conf.php with email settings
- git add mail/MailHandler.php process_signup.php ClassAutoLoad.php forms.php conf.php
- git commit -m "Added email validation and welcome email system"
- git push origin feature/email-system

2. DATABASE INTEGRATION (Part II)  
- git checkout -b feature/database-integration
- Created database/Database.php for database operations
- Created users.php for numbered user list display
- Created create_table.php for database setup
- Updated ClassAutoLoad.php to include Database class
- Updated process_signup.php to save users to database
- Updated conf.php with database settings
- git add database/Database.php users.php create_table.php ClassAutoLoad.php process_signup.php conf.php
- git commit -m "Added database integration and user listing"
- git push origin feature/database-integration


3. TESTING
- Tested email validation with valid and invalid emails
- Tested welcome emails with username personalization
- Tested user registration and database storage
- Tested numbered user list in ascending order
- Verified all functionality works correctly



4. FILES CREATED/MODIFIED
Created:
- mail/MailHandler.php
- process_signup.php  
- database/Database.php
- users.php
- create_table.php
- GIT_WORKFLOW.md

Modified:
- ClassAutoLoad.php
- forms.php
- conf.php

