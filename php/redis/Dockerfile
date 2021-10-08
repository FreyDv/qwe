# Для начала указываем исходный образ, он будет использован как основа
FROM redis:latest
# не сработало RUN echo '[PHP]\ndate.timezone = "Europe/Kiev"\n' > /usr/local/etc/php/conf.d/tzone.ini


COPY redis.conf /usr/local/etc/redis/redis.conf
CMD [ "redis-server", "/usr/local/etc/redis/redis.conf" ]

