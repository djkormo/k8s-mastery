#FROM nginx
#COPY build /usr/share/nginx/html


#FROM mhart/alpine-node:9 as BASE
#WORKDIR /app
#COPY package.json yarn.lock ./
#RUN yarn install --production
#COPY ./src ./src

# test image installs development dependencies
# and runs testing commands
# derived from BASE
FROM BASE as TEST
# Copy files _from_ BASE
# To avoid accidentally creating different
# testing environment from production
#COPY --from=BASE /app .
#COPY .eslintrc.json .

#RUN yarn
#RUN yarn run lint
#RUN yarn run test

# final production image uses base no npm or yarn here
#FROM mhart/alpine-node:base-9
#COPY --from=BASE /app .

#EXPOSE 80
#CMD ["node", "src/index.js"]

#FROM nginx
#COPY build /usr/share/nginx/html

# build environment
FROM node:12.2.0-alpine as build
WORKDIR /app
ENV PATH /app/node_modules/.bin:$PATH
COPY package.json /app/package.json
COPY yarn.lock /app/yarn.lock
RUN npm install #--silent
RUN npm install react-scripts@3.0.1 -g #--silent
COPY . /app
RUN npm run build


# production environment
#FROM nginx:1.16.0-alpine
#COPY --from=build /app/build /usr/share/nginx/html
#EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]