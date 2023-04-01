#ssh root@172.17.0.1 /usr/bin/hostname
ssh  -o stricthostkeychecking=no  root@172.20.0.1 /usr/bin/hostname
#ssh  -o stricthostkeychecking=no  root@172.20.0.1 "docker run -d   --network biz_net --ip 169.10.0.4       my_web_ssh:09.01.01"  
ssh  -o stricthostkeychecking=no  root@172.20.0.1 " /root/app/controller/docker-start.sh my_web_ssh 09.01.01  169.10.0.4 "
