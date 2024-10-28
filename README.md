# Random WordPress Page Creator

This project is a standalone PHP script for creating random pages on a WordPress site. It enables the creation of new WordPress pages without the need for user login, making it ideal for automated testing scenarios, such as load testing with Loader.io.

**Warning**: This script should be used only in development or testing environments as it bypasses WordPress authentication and security checks.

## Features

- Creates new WordPress pages with random titles and content.
- Can be used by any client with access to the correct URL and token.
- Ideal for testing and load testing on WordPress sites.

## Prerequisites

- A WordPress site with database access credentials
- (Optional) Loader.io for load testing

## Setup Instructions

1. **Download the Project Files**: Clone the repository or download the script file (`create-random-page.php`).

   ```bash
   git clone https://github.com/yourusername/random-wordpress-page-creator.git
````

2. **Configure Database and Token**: Update the database connection details and security token in `create-random-page.php`:
   - **DB\_NAME**: Name of your WordPress database.
   - **DB\_USER**: Username for the WordPress database.
   - **DB\_PASSWORD**: Password for the WordPress database user.
   - **DB\_HOST**: Database host, typically `localhost`.
   - **WP\_PREFIX**: WordPress table prefix, typically `wp_`.
   - **$secure\_token**: A unique token for secure access (e.g., `'your-secure-token'`). Replace `'your-secure-token'` with an actual token.

3. **Upload the Script**: Place `create-random-page.php` in the root directory of your WordPress site.

## Usage Instructions

To create a random page, navigate to the following URL in your browser:

```
https://yourwebsite.com/create-random-page.php?token=your-secure-token
```

Replace `your-secure-token` with the token you set up in the configuration. A new WordPress page with a random title and content will be generated each time the URL is accessed with the correct token.

## Loader.io Load Testing Instructions

To use this script with Loader.io for load testing:

1. **Register and Verify**: Sign up for a Loader.io account and add your WordPress domain for verification. You can verify your domain using a token file or meta tag, as specified in Loader.io’s setup instructions.

2. **Create a Test with POST Requests**:
   - In Loader.io, create a new test and set it to use POST requests.

   - Set the target URL to the script with the correct token:

     ```
     https://yourwebsite.com/create-random-page.php?token=your-secure-token
     ```

   - **Configure Test Options**:
     - Set the number of clients (virtual users) and request rate according to your testing requirements.
     - Adjust the duration of the test for an appropriate load.

3. **Run the Test**: Execute the test, and Loader.io will create new pages by sending POST requests to your WordPress site.

## Notes

- This script bypasses WordPress authentication, so **do not use it on production sites** without adding additional security.
- Ensure the token is kept secret and not shared with anyone else, as anyone with the correct URL and token can create pages on your WordPress site.

## License

This project is open-source and available under the MIT License. See the [LICENSE](LICENSE) file for details.
