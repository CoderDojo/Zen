### CoderDojo Zen
Initially a basic Dojo listing manager. We plan to enhance and add features down 
the line. You can help us make it better by forking this project, adding stuff and then issuing
a pull request back to us!

### Some things to add/hack/dream about
- User settings
- Improved admin panel
- Improved overall Dojo list w/ search
- Mutliple admins on a Dojo
- If country == US, have states also.

### Zen is built on and uses: 
- CodeIgniter http://codeigniter.com/
- Tank Auth http://www.konyukhov.com/soft/tank_auth/
- Twitter Bootstrap http://twitter.github.com/bootstrap/

### Local deployment notes 
- Be sure to create a MySQL database wth the schema in `'/schema.sql'`, then fill in the details in  `'/application/config/database.php'`. Be sure also to enter an encryption key in `'/application/config/config.php'` on line 227, as Zen uses the session class.
- You will also need reCaptcha keys from https://www.google.com/recaptcha/admin/create for the captcha used through the app, fill in the keys on lines 131 and 132 in `'/application/config/tank_auth.php'`.
- Also note `.htaccess` is used to mask the `'index.php'` part of the URL, depending on your set up, you may need to edit this. 
