#!/bin/bash
git checkout gh-pages && git merge --no-ff -m "Merging 'master' into 'gh-pages'" master && git checkout master && git push