# Whats Covered
## What is used
- For authentication breeze auth scalfolding is used. utilizing tailwindcss CSS framework and blade template engine.
- For database, MYSQL is used.
## Authentication
I have used breeze to manage all the authentication process, from user registration to email verification.
## Pages
Dashboard and profile pages are only acessable after the user login, because these pages are guarded by auth middleware, and dashboard page have extra middleware 'verified' to check if the user has verified their email address
## Dashboard
This is simple dashboard page where the datatable is shown. the data for the datatable is loaded via an api endpoint '/table-data', when dashboard page is completely loaded.
The datatable on this page has a refresh button below it which will make an GET request to '/table-data' endpoint to fetch results and refresh the datatable with updated records.
## /table-data API Endpoint
This endpoint only can be used when user is logged in and thier email is verified. This api endpoint is also rate limited to only allow 1 request per 60 minutes per logged in user or ip address.
This endpoint make GET request to external api endpoint to fetch results and return results.
