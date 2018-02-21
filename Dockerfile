FROM alpine:3.7

RUN apk --no-cache add gnumeric php5 fontconfig ttf-opensans

# Not sure why this is necessary, copied it from
# an existing ssconvert image		
RUN mkdir /.cache && chmod -R 777 /.cache

RUN mkdir /app

ENV APP_HOME /app

WORKDIR $APP_HOME

COPY index.php /app

ENTRYPOINT ["/usr/bin/php5",  "-S",  "0.0.0.0:80"]

EXPOSE 80