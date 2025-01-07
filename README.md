## LIST of PORTAL
- ESS portal    | DashboardController
- HR2 portal    | DashboardController
- Admin portal  | DashboardController

## CRU Create, Read, Update
used for filename
- ├── index.blade.php    # List of tickets
- ├── create.blade.php   # Form to create a new ticket
- ├── show.blade.php     # View details of a specific ticket
- ├── edit.blade.php     # Form to edit a ticket
## CRUD in CONTROLLER
used for controller
- php artisan make:controller UserController --resource

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
