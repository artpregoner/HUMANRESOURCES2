## LIST of PORTAL
- **ESS portal**:
  - https://hr2.fareastcafeshop.com/portal
  - PortalController: Controller for portal dashboard and etc...
  - home.blade.php: Name of main dashboard file
- **HR2 portal**:
  - https://hr2.fareastcafeshop.com/hr2
  - HR2Controller: Controller for HR2 dashboard
  - index.blade.php: Name of main dashboard file
- **Admin portal**:
  - AdminController: Controller for Admin dashboard
  -

## FILENAME for RESOURCES
- **├── index.blade.php**
  -  List of all resources: 
    - Typically used for the list view where you display all the records for a specific model (users, tickets, etc.).
- **├── create.blade.php**
  -  Form to create a new resources: 
    - Used for the form to add a new record. This could contain fields that you want to save into the database.
- **├── show.blade.php**
  -  View details of a specific resources: 
    - Used to display details of a single resource. Usually, this shows more detailed information for a single record.
- **├── edit.blade.php**
  -  Form to edit a resources: 
    - Displays a form for editing an existing resource. It is pre-filled with the existing data that can be modified and saved.

## Resource Controller Routes
- php artisan make:controller UserController --resource
- The following table lists the RESTful routes generated by a Laravel resource controller:

- **├── index()**:
  - Display a list of all resources.
- **├── create()**:
  - Show a form to create a new resource.
- **├── store(Request $request)**:
  - Store a newly created resource in the database.
- **├── show($id)**:
  - Display a specific resource.
- **├── edit($id)**:
  - Show a form to edit an existing resource.
- **├── update(Request $request, $id)**:
  - Update an existing resource in the database.
- **├── destroy($id)**:
  - Delete a specific resource.

| HTTP Method | URI                 | Action  | Controller Method  |
|-------------|---------------------|---------|--------------------|
| GET         | /resources          | index   | `index()`          |
| GET         | /resources/create   | create  | `create()`         |
| POST        | /resources          | store   | `store()`          |
| GET         | /resources/{id}     | show    | `show()`           |
| GET         | /resources/{id}/edit| edit    | `edit()`           |
| PUT/PATCH   | /resources/{id}     | update  | `update()`         |
| DELETE      | /resources/{id}     | destroy | `destroy()`        |

## Employee Portal routes
Portal
- /portal
- portal/myprofile

Self-service

- portal/self-service/payslip
- portal/self-service/leave/list/requests
- portal/self-service/leave/list/history


Claims

- portal/expense/list/requests

Helpdesk

- portal/helpdesk/list
- portal/helpdesk/create


## HR2 Portal routes
Portal
- /hr2

Self-service

- /hr2/self-service/payslip
- /hr2/self-service/leave/list/requests
- /hr2/self-service/leave/list/history


Claims

- /hr2/expense/list/requests

Helpdesk

- /hr2/helpdesk/list
- /hr2/helpdesk/create


php artisan serve


php artisan view:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan optimize

php artisan migrate:reset
php artisan migrate:status
php artisan migrate:fresh
