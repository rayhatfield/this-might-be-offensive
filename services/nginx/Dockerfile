FROM nginx

RUN apt-get update && apt-get install -y openssl && rm -rf /var/lib/apt/lists/*

COPY ./src/default.conf /etc/nginx/conf.d/default.conf
COPY ./src/common.conf /etc/nginx/conf.d/common.conf
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
