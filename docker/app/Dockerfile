# どんな docker イメージを利用して構築をするか
FROM php:8.0-apache

# 設定ファイルをdockerコンテナ内のPHP、Apacheに読み込ませる
ADD php.ini /usr/local/etc/php/
ADD 000-default.conf /etc/apache2/sites-enabled/

# Composerのインストール
# RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

# # Cronをインストール
# RUN apt-get update && apt-get install -y cron

# # Laravelのスケジューリング用のCronジョブを設定
# # 注意：この行では毎分cronが動く設定になっています。
# RUN echo "* * * * * cd /var/www/html/laravel && php artisan schedule:run >> /dev/null 2>&1" >> /etc/crontab

# Cronデーモンを起動（コメントアウトを解除してください）
#sCMD ["cron", "-f"]

# ミドルウェアのインストール
RUN apt-get update \
&& apt-get install -y \
git \
zip \
unzip \
vim \
libpng-dev \
libpq-dev \
&& docker-php-ext-install pdo_mysql

# Laravelで必要になるmodRewriteを有効化する
RUN mv /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled
RUN /bin/sh -c a2enmod rewrite
