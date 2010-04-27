#!/bin/sh
rm -r -f dist
mkdir dist
cd src/app/plugins
tar cvzf ../../../dist/kaching-0.5-beta.tar.gz --exclude '.svn' kaching/*
cd ../../..
