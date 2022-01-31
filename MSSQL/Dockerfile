FROM php:8.0-apache
RUN apt update && apt install unixodbc-dev gnupg gnupg2 gnupg1 unixodbc -y && \
    curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - && \
    curl https://packages.microsoft.com/config/debian/10/prod.list > /etc/apt/sources.list.d/mssql-release.list && \
    apt update && \
    ACCEPT_EULA=Y apt-get install -y msodbcsql17 mssql-tools
RUN pecl install sqlsrv && \
    pecl install pdo_sqlsrv