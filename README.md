## LIST of PORTAL
- <span style="color: teal;">**ESS portal**</span>:
  - DashboardController
  - home.blade.php
- <span style="color: teal;">**HR2 portal**</span>:
  - DashboardController
  - dashboard.blade.php
- <span style="color: teal;">**Admin portal**</span>:
  - DashboardController
  -

## FILENAME for RESOURCES
- <span style="color: green;">**├── index.blade.php**</span>:   
  -  List of all resources: 
    - Typically used for the list view where you display all the records for a specific model (users, tickets, etc.).
- <span style="color: green;">**├── create.blade.php**</span>:   
  -  Form to create a new resources: 
    - Used for the form to add a new record. This could contain fields that you want to save into the database.
- <span style="color: green;">**├── show.blade.php**</span>:  
  -  View details of a specific resources: 
    - Used to display details of a single resource. Usually, this shows more detailed information for a single record.
- <span style="color: green;">**├── edit.blade.php**</span>:     
  -  Form to edit a resources: 
    - Displays a form for editing an existing resource. It is pre-filled with the existing data that can be modified and saved.

## Resource Controller Routes
- php artisan make:controller UserController --resource
- The following table lists the RESTful routes generated by a Laravel resource controller:

- <span style="color: yellow;">**├── index()**</span>:
  - Display a list of all resources.
- <span style="color: yellow;">**├── create()**</span>:
  - Show a form to create a new resource.
- <span style="color: yellow;">**├── store(Request $request)**</span>:
  - Store a newly created resource in the database.
- <span style="color: yellow;">**├── show($id)**</span>:
  - Display a specific resource.
- <span style="color: yellow;">**├── edit($id)**</span>:
  - Show a form to edit an existing resource.
- <span style="color: yellow;">**├── update(Request $request, $id)**</span>:
  - Update an existing resource in the database.
- <span style="color: yellow;">**├── destroy($id)**</span>:
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
