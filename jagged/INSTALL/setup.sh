#!/bin/sh

uname=user
passwd=pass

MYSQLADMIN=`which mysqladmin`

$MYSQLADMIN -u ${uname} -p'${passwd}' < tables.sql
