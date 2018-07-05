## Task description
[TASK.md](/TASK.md)

Notes on implementation:
- used symfony version 3.4 
- for interaction with github used library https://github.com/KnpLabs/php-github-api
- form data submition and validation done with forms
- when installing composer will request github_client_id, github_client_secret. if no values provided github will rate limit requests, but app would work

## Screenshots

### Form for submitting github username
![page with form](/web/images/create.png)

### Validation error
![page with form](/web/images/error.png)

### Resume page
![page with form](/web/images/resume.png)