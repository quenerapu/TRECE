# TRECE
A Content Management System for the brave. Because what could go wrong?

## Installation

### Step 1

[Download the .zip](https://github.com/quenerapu/TRECE/archive/master.zip "Download the .zip") containing the TRECE files.

### Step 2

Edit `conf/core.php` lines 17-22 (eMail configuration) and lines 29-30 (reCAPTCHA) to fit your needs:

```php
  "mail"         =>  [
# --------------------------------------------------------------------
//  "need_mail"  =>  $forgot_pass."|".$change_pass."|".$users, # Add other actions wich need use of eMail
    "from"       =>  "email@domain.com",
    "host"       =>  "domain.com",
    "username"   =>  "email@domain.com",
    "password"   =>  "1234",
    "tls_or_ssl" =>  "tls",
    "port"       =>  587,
  ],
  "recaptcha" =>  [ # reCAPTCHA: https://www.google.com/recaptcha
# --------------------------------------------------------------------
    "public"  =>  "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
    "secret"  =>  "yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy",
  ],
```

### Step 3

Edit `conf/core.php` line 91 replacing `inconceivable` with another hard to guess character string:

```php
    "entropy"           =>  $entropy="inconceivable",
```

### Step 4

Edit `conf/db.php` lines 12-15 (database configuration) to fit your needs:

```php
    private $host     = "localhost";
    private $db_name  = "db_name";
    private $username = "db_username";
    private $password = "1234";
```

### Step 5

Edit `inc/users/tables.sql` line 38, replacing `email@domain.com` with your current eMail address:

```sql
(1, 1, 0, 1, 0, 'The Boss', 'Is In The House', 'theboss', 'm', 'email@domain.com', '', NULL, '0000-00-00 00:00:00', '0.0.0.0', 0, '', NOW(), NOW(), '0.0.0.0', LEFT(UUID(),8), 0);
```

### Step 6

That's all! :) Upload all the files, visit your brand new installation of TRECE with your browser, click on «Sign In» and then click on «Forgot or don't know my password». Follow instructions to generate your password, sign in and test the site.
