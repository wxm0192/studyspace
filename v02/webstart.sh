docker run  -v /root/app:/app --network mgt_net --ip 172.20.0.2 -p 80:80  webdevops/php-nginx:latest 
#docker run -p 80:80 -v /root/app:/app    webdevops/php-nginx:latest 
