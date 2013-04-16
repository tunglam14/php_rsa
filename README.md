php_rsa
=======

RSA en/de-crypt in php

1. Generate public.pem & private.pem

- Private file:
openssl genrsa -des3 -out private.pem 1024
Enter 'phrase' and remember it

(phrase of private.pem is: '123456')

- Public file
openssl rsa -in private.pem -out public.pem -outform PEM -pubout

2. rsa classs and demo in rsa.php

contact: lamdt@familug.org
