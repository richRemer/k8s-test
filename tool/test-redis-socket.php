<?php

\$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

if (!is_resource(\$socket)) {
  fprintf(STDERR, "failed to create socket\n");
  exit(1);
}

if (!socket_connect(\$socket, "redis", 6379)) {
  fprintf(STDERR, "could not connect to redis:6379\n");
  exit(1);
}

switch (\$argv[1]) {
  case "read":
    socket_write(\$socket, "GET testkey\n");
    sleep(0.5);
    echo socket_read(\$socket, 1024, PHP_NORMAL_READ);
    break;
  case "write":
    socket_write(\$socket, "SET testkey scriptval\n");
    sleep(0.5);
    echo socket_read(\$socket, 1024, PHP_NORMAL_READ);
    break;
  default:
    echo "did nothing\n";
}
