FROM node:12-alpine

RUN apk add --no-cache bash

USER node

RUN mkdir /home/node/.npm-global
ENV PATH=/home/node/.npm-global/bin:$PATH
ENV NPM_CONFIG_PREFIX=/home/node/.npm-global

ENV HOME=/home/node

WORKDIR $HOME/app

RUN npm i -g npm

RUN echo n | npm install -g --silent @angular/cli && npm cache clean --force

EXPOSE 4200

CMD [ "node" ]