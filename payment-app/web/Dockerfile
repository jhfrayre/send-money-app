FROM node:20-alpine3.17

RUN apk update && apk add --no-cache \
    bash \
    git \
    vim nano \
    util-linux

WORKDIR /var/www/html
COPY . /var/www/html
RUN npm install
ENTRYPOINT npm run dev -- --host 0.0.0.0 --port 5173
