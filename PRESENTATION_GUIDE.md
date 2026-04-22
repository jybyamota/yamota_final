# EduManager - Presentation Guide (Explanations Only)

## 1. Framework Used: Laravel 12

**What is Laravel?**
- Laravel is a modern PHP web framework that provides a clean, elegant syntax for building web applications
- It follows the MVC (Model-View-Controller) architectural pattern
- Built with convention over configuration principle, meaning developers follow standardized patterns

**Why Laravel for this project?**
- Provides built-in authentication system for user login/logout
- Strong routing system for managing application URLs
- Eloquent ORM for database interactions (object-relational mapping)
- Blade templating engine for creating dynamic HTML views
- Middleware support for handling cross-cutting concerns (authentication, authorization)
- Built-in validation system for form data
- Database migration system for version control of database schema

---

## 2. Login/Logout Functionality

**Authentication Flow:**
- When a user attempts to login, the system validates credentials against the database
- Laravel's `Auth` facade handles user authentication
- Passwords are hashed using bcrypt algorithm for security (one-way encryption)
- Once authenticated, a session token is created and stored in a secure cookie
- This session persists the user's identity across multiple requests

**Session Management:**
- Sessions keep the user logged in during their browsing session
- The session ID is stored in the database and the user's browser (secure HTTP-only cookie)
- On logout, the session is destroyed and the user is redirected to the login page
- Laravel middleware automatically checks if the user is authenticated for protected routes

**Security Measures:**
- CSRF (Cross-Site Request Forgery) protection on all forms using tokens
- Password reset functionality available for forgotten passwords
- Prepared statements prevent SQL injection attacks

---

## 3. Subject Management

**What Subject Management Does:**
- Allows administrators and staff to create, read, update, and delete academic subjects
- Each subject has attributes: code (e.g., CS101), title, and unit value (credit hours)

**Data Structure:**
- Subjects are stored in the database with fields: subject_id, code, title, unit, created_on, created_by, updated_on, updated_by
- Records track who created and modified each subject for audit purposes
- Timestamps track when changes were made

**Access Control:**
- Only admin and staff members can create/edit subjects
- Students and teachers have read-only access
- Middleware checks user roles before allowing modifications

**Operations (CRUD):**
- **Create**: Staff can create new subjects with validation (code must be unique)
- **Read**: All authenticated users can view subject list
- **Update**: Staff can modify subject details with change tracking
- **Delete**: Restricted to prevent accidental data loss (removed from list view for standard users)

---

## 4. Program Management

**What Program Management Does:**
- Manages academic programs (like Bachelor of Science in Computer Science)
- Programs represent complete degree paths with a specified duration
- Each program can contain multiple subjects

**Data Structure:**
- Programs are stored with: program_id, code, title, years (duration), created_on, created_by, updated_on, updated_by
- Tracks program creation and modifications with user accountability
- Duration is stored as number of years for the program completion

**Access Control:**
- Admin and staff can create/modify programs
- All authenticated users can view programs
- Audit trail maintained through created_by and updated_by fields

**Relationship:**
- Program and Subject entities are separate but can be linked in the database
- A program may consist of multiple subjects across different years

---

## 5. User Account Management (Admin Only)

**User Management System:**
- Administrators can create, view, edit, and delete system users
- Users are assigned roles: admin, staff, teacher, student

**User Account Details:**
- Username: unique identifier for login
- Password: bcrypt hashed for security
- Account Type: determines access level and permissions
- Created On/By: timestamp and admin who created the account
- Updated On/By: timestamp and admin who last modified the account

**Role Definitions:**
- **Admin**: Full system access, can manage users and content
- **Staff**: Can create/modify subjects and programs
- **Teacher**: Read-only access to subjects and programs
- **Student**: Read-only access to subjects and programs

**Audit Trail:**
- Every user creation is tracked with the admin who created it
- Every user modification is tracked with timestamp and admin who made changes
- This maintains accountability and allows tracking of system changes

---

## 6. Change Password Functionality

**Purpose:**
- Allows all authenticated users to change their account password
- Essential security feature for account protection

**Process:**
- User enters current password (verified against stored hash)
- User enters new password twice (must match for confirmation)
- Validation ensures password meets security requirements (minimum 6 characters)
- New password is hashed using bcrypt before storing in database
- System logs the change with timestamp
- User is logged out automatically after password change (security measure)

**Security Considerations:**
- Current password is verified to prevent unauthorized password changes
- Password confirmation prevents typos
- Hashing ensures passwords are never stored in plaintext
- No email confirmation needed (internal system security)

---

## 7. Project Structure Inside the Framework

**Directory Organization:**

```
app/
├── Http/
│   ├── Controllers/        # Application controllers handling business logic
│   ├── Middleware/         # Authentication & authorization checks
│   └── Requests/          # Form request validation classes
├── Models/                # Database model classes (Subject, Program, User)
└── Providers/             # Service providers for bootstrapping services

routes/
└── web.php                # All web application routes defined here

database/
├── migrations/            # Database schema version control files
├── factories/             # Test data generation factories
└── seeders/               # Database seed files for initial data

resources/
├── views/                 # Blade template files (HTML with PHP)
│   ├── layouts/          # Layout templates (navbar, structure)
│   ├── dashboard/        # Dashboard pages
│   ├── subjects/         # Subject management views
│   ├── programs/         # Program management views
│   ├── users/            # User management views
│   └── auth/             # Login/logout views
├── css/                  # CSS stylesheets
└── js/                   # JavaScript files

config/
├── app.php               # Application configuration
├── auth.php              # Authentication configuration
├── database.php          # Database connection settings
└── session.php           # Session management settings

storage/
├── app/                  # File storage for user uploads
├── framework/            # Framework generated files (cache, sessions)
└── logs/                 # Application log files
```

---

## 8. Routing Explanation

**What is Routing?**
- Routing maps HTTP requests (URLs) to controller actions
- Routes define what happens when a user visits a specific URL
- Uses a pattern matching system to capture parameters from URLs

**Route Groups:**
- **Guest Routes**: Accessible only to unauthenticated users (login page)
- **Authenticated Routes**: Protected routes requiring login (dashboard, management)

**Route Types Used:**
- **GET routes**: Retrieve and display data (view pages)
- **POST routes**: Submit form data to create resources
- **PUT routes**: Submit form data to update resources
- **DELETE routes**: Remove resources from system

**Route Parameters:**
- Dynamic segments in URLs like `{subject}` capture values
- These parameters are passed to controller methods for processing
- Example: `/subjects/{subject}/edit` captures the subject ID

**Middleware in Routes:**
- Authentication middleware checks if user is logged in
- Authorization middleware checks if user has permission for action
- Example: Only admin/staff can access subject creation routes

---

## 9. Controllers Explanation

**What is a Controller?**
- Controllers are classes that handle the application logic
- They receive requests, process data, and send responses
- Act as the intermediary between routes and models/views

**Request Processing:**
- Controller receives HTTP request with form data or query parameters
- Validates input data using Laravel validation rules
- Processes the business logic (create/update/delete operations)
- Returns a response (view, redirect, or JSON)

**Key Controller Methods (CRUD Operations):**

**Index()** - List/Display
- Retrieves all records from database
- Passes data to view for display
- Example: Shows all subjects in a table

**Create()** - Show Form
- Displays an empty form for creating new record
- No database interaction
- Passes empty data and role options to view

**Store()** - Save New Record
- Validates form submission data
- Checks for duplicate entries (unique constraints)
- Saves record to database with audit information (created_by)
- Redirects to list view with success message

**Edit()** - Show Edit Form
- Retrieves specific record by ID
- Displays form pre-filled with current data
- Passes record and available options to view

**Update()** - Save Changes
- Validates updated form data
- Updates database record with new values
- Tracks changes with updated_on and updated_by fields
- Redirects to list view with success message

**Destroy()** - Delete Record
- Retrieves record by ID
- Deletes record from database
- Redirects to list view confirming deletion

---

## 10. Models Explanation

**What is a Model?**
- Models represent database tables and their data
- Model is a class that maps to a database table
- Provides methods to query, create, update, and delete records
- Uses Eloquent ORM (Object-Relational Mapping) to convert database rows to objects

**Model Structure:**
- Properties define which database columns are fillable (mass assignable)
- Relationships define connections to other models
- Methods access and manipulate data

**Key Models in Project:**

**User Model**
- Represents system users in the users table
- Has relationships to subjects (via created_by) and programs (via created_by)
- Methods: `isAdmin()`, `isStaff()` to check user roles
- Tracks audit information: created_by, updated_by timestamps

**Subject Model**
- Represents academic subjects
- Fillable fields: code, title, unit, created_by, updated_by, updated_on
- Relationships: belongs to User who created it
- Has timestamps: created_on, updated_on for audit trail

**Program Model**
- Represents academic programs
- Fillable fields: code, title, years, created_by, updated_by, updated_on
- Similar audit trail tracking as Subject
- Can be associated with multiple subjects

**Relationships:**
- `belongsTo()`: Model belongs to another model (Subject belongs to User who created it)
- `hasMany()`: Model has many of another model (User has many subjects created)
- Enables querying related data efficiently

---

## 11. Views Explanation

**What are Views?**
- Views are HTML templates that display data to users
- Uses Blade templating engine (Laravel's templating system)
- Converts dynamic PHP code into HTML sent to browser

**Blade Templating Features:**

**Variables and Expressions**
- `{{ $variable }}` - Outputs PHP variable as HTML
- `{{ $user->name }}` - Accesses object properties
- `{{ implode(', ', $array) }}` - Calls PHP functions

**Control Structures**
- `@if, @else, @endif` - Conditional rendering
- `@foreach, @endforeach` - Loop through data collections
- `@auth, @endauth` - Show content only if authenticated

**Form Directives**
- `@csrf` - Adds CSRF token for security
- `@method()` - Specifies HTTP method (PUT, DELETE, etc.)

**Components Included**
- Reusable layouts for consistent UI across pages
- Navigation bar with user menu
- Alert messages for success/error feedback
- Form validation error displays

**View Files Structure:**
- **layouts/app.blade.php**: Main layout template with navbar and sections
- **dashboard/index.blade.php**: Dashboard home page with quick actions
- **subjects/index.blade.php**: List all subjects with edit options
- **subjects/create.blade.php**: Form to create new subject
- **subjects/edit.blade.php**: Form to edit existing subject
- **programs/** & **users/**: Similar structure for program and user management
- **auth/**: Login and registration views

**Data Passing:**
- Controllers pass data to views using `compact()` or array syntax
- Views receive data as variables that can be used in templates
- Data is safely escaped to prevent XSS (Cross-Site Scripting) attacks

---

## 12. Database and Migrations

**What are Migrations?**
- Migrations are version control for database schema
- Each migration represents a change to database structure
- Allows team members to stay in sync with database structure

**Key Tables:**

**users table**
- id: unique identifier
- username: unique login identifier
- password: bcrypt hashed password
- account_type: enum (admin, staff, teacher, student)
- created_on, created_by, updated_on, updated_by: audit trail

**subjects table**
- subject_id: primary key
- code: unique subject code
- title: subject name
- unit: credit hours
- created_on, created_by, updated_on, updated_by: audit trail

**programs table**
- program_id: primary key
- code: unique program code
- title: program name
- years: program duration
- created_on, created_by, updated_on, updated_by: audit trail

---

## Summary of Application Flow

1. **User Access**: User visits login page (unauthenticated)
2. **Authentication**: User enters credentials, which are validated and session created
3. **Dashboard**: User redirected to dashboard after successful login
4. **Navigation**: User uses navigation menu to access subjects/programs/users
5. **Data Display**: Controller retrieves data, passes to view for rendering
6. **User Actions**: User can create/edit/delete based on their role
7. **Audit Trail**: System tracks who made changes and when
8. **Logout**: User session is destroyed, redirected to login page

---

## Key Security Features Explained

**Authentication**: Validates user identity through password verification
**Authorization**: Checks user roles/permissions before allowing actions
**Session Management**: Maintains user state across multiple requests
**Password Hashing**: bcrypt algorithm ensures passwords can't be reversed
**CSRF Protection**: Tokens prevent attacks from other websites
**Input Validation**: Server-side validation prevents invalid/malicious data
**Prepared Statements**: Prevent SQL injection attacks
**Audit Trail**: Tracks all modifications for accountability
