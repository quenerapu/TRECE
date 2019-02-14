# TRECE
A Content Management System for the brave. Because what could go wrong?

## Installation

### Step 1

[Download the .zip](https://github.com/quenerapu/TRECE/archive/master.zip "Download the .zip") containing the TRECE files.

### Step 2

![](https://trece.io/img/step_2.png)

Edit `index.php` and change the word "inconceivable" (line 13) for another word. Remember: the harder to deduce, the better.

### Step 3

![](https://trece.io/img/step_3.png)

Open `tables.sql` and replace every occurrence of the word "inconceivable" with the word you chose in the previous step. **Replace. Them. All**.

### Step 4

![](https://trece.io/img/step_4.png)

In the same file, find the table formerly known as `inconceivable_users` and replace the fake email address `email@domain.com` with a real email address of your own.

### Step 5

Now you can upload all these queries to your MySQL database.

### Step 6

![](https://trece.io/img/step_6.png)

Open `core/conf.php`, go to lines 156 - 161 and replace the fake email configuration with the right one. This is the email account to send eMails from TRECE.

### Step 7

![](https://trece.io/img/step_7.png)

In the same file, lines 227 - 228, change the reCaptcha keys (public and secret) with yours. If you don't have one, Google provides them at https://www.google.com/recaptcha

### Step 8

![](https://trece.io/img/step_8.png)

Edit `core/db.php` to replace the fake database configuration with the real info.

### Step 9

You're done! Upload to your site host all the files (except `tables.sql`, obviously).

### Step 10

![](https://trece.io/img/step_10.png)

Visit your brand new TRECE installation, click on **Sign in** and tell TRECE that you «forgot or don't know your password». You will receive an email with instructions. Not sure if you'll have to search for it at the spam box, sorry.
