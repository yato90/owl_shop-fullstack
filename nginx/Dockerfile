# Nginx Dockerfile
FROM nginx:alpine

# Копируем конфигурацию Nginx
COPY nginx.conf /etc/nginx/nginx.conf

COPY proxy_params /etc/nginx/proxy_params

# Экспорт порта для доступа к Nginx
EXPOSE 80

# Запускаем Nginx
CMD ["nginx", "-g", "daemon off;"]
