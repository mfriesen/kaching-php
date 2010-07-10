#!/bin/sh
rm -r -f dist
mkdir dist
cd src/app/plugins
tar cvzf ../../../dist/kaching-0.51.tar.gz --exclude '.git' kaching/*
cd ../../..
