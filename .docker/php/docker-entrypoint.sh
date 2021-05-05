#!/bin/sh

if [[ $UID != 82 ]]; then
   echo "change UID: " + $UID
   su-exec root usermod -u $UID www-data
fi;

if [[ $GID != 82 ]]; then
  echo "change GID: " + $GID
  su-exec root groupmod -g $GID www-data
fi;

exec su-exec www-data "$@"
