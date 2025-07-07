#!/bin/bash

mkdir -p ssl

openssl req -x509 -nodes -days 365 \
  -newkey rsa:2048 \
  -keyout ssl/ssl.key \
  -out ssl/ssl.crt \
  -subj "/C=RU/ST=Moscow/L=Moscow/O=TestCompany/OU=Dev/CN=localhost"
