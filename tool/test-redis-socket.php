<?php

\$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

socket_connect(\$socket, "redis", 6379);
socket_write(\$socket, "SET testkey testval\n");

while (true) {
  echo socket_read(\$socket, 1024, PHP_NORMAL_READ);
  sleep(1);
}
