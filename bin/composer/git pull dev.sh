#!/bin/sh
cd ../../vendor

git clone "git@github.com:php7lab/core.git" "php7lab-dev/core"
git clone "git@github.com:php7lab/dev.git" "php7lab-dev/dev"
git clone "git@github.com:php7lab/eloquent.git" "php7lab-dev/eloquent"

git clone "git@github.com:php7bundle/telegram-client.git" "php7bundle-dev/telegram-client"

git clone "git@github.com:php7fork/danog_madelineproto.git" "php7fork-dev/danog_madelineproto"
