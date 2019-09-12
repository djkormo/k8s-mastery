
## Deploying simple application

### sa-frontend (php) -> sa-webapp (java) -> sa-logic (python)


![Parts of our application](architecture.gif)

#### Images from DockerHub

#### sa-frontend -> djkormo/sa-frontend
#### sa-webapp -> djkormo/sa-webapp
#### sa-logic -> djkormo/sa-logic

```console
kubectl apply -f sa-frontend-deployment.yaml
```
<pre>
deployment.extensions/sa-frontend created
</pre>

```console
kubectl get all
```
<pre>
NAME                              READY   STATUS    RESTARTS   AGE
pod/sa-frontend-6855db697-g7xkq   1/1     Running   0          44s
pod/sa-frontend-6855db697-s5nrv   1/1     Running   0          44s

NAME                          READY   UP-TO-DATE   AVAILABLE   AGE
deployment.apps/sa-frontend   2/2     2            2           44s

NAME                                    DESIRED   CURRENT   READY   AGE
replicaset.apps/sa-frontend-6855db697   2         2         2       44s
</pre>

```console
kubectl apply -f service-sa-webapp-lb.yaml
```
<pre>
service/sa-webapp-lb created
</pre>

```console
kubectl get svc
```
<pre>
NAME             TYPE           CLUSTER-IP     EXTERNAL-IP     PORT(S)        AGE
sa-frontend-lb   LoadBalancer   10.0.55.106    168.63.46.17    80:30502/TCP   21m
</pre>

```console
kubectl apply -f sa-webapp-deployment.yaml
```
<pre>
deployment.extensions/sa-webapp created
</pre>

```console
kubectl apply -f service-sa-webapp-lb.yaml
```
<pre>
service/sa-webapp-lb unchanged
</pre>

```console
kubectl get svc
```
<pre>
NAME             TYPE           CLUSTER-IP     EXTERNAL-IP     PORT(S)        AGE
kubernetes       ClusterIP      10.0.0.1       <none>          443/TCP        26d
sa-frontend-lb   LoadBalancer   10.0.55.106    168.63.46.17    80:30502/TCP   31m
sa-webapp-lb     LoadBalancer   10.0.146.185   13.69.139.248   80:31140/TCP   11m
</pre>

```console
kubectl logs svc/sa-webapp-lb
```
<pre>
        ...
        at org.apache.tomcat.util.net.SocketProcessorBase.run(SocketProcessorBase.java:49) [tomcat-embed-core-8.5.23.jar!/:8.5.23]
        at java.util.concurrent.ThreadPoolExecutor.runWorker(ThreadPoolExecutor.java:1149) [na:1.8.0_222]
        at java.util.concurrent.ThreadPoolExecutor$Worker.run(ThreadPoolExecutor.java:624) [na:1.8.0_222]
        at org.apache.tomcat.util.threads.TaskThread$WrappingRunnable.run(TaskThread.java:61) [tomcat-embed-core-8.5.23.jar!/:8.5.23]
        at java.lang.Thread.run(Thread.java:748) [na:1.8.0_222]
        ...
</pre>

```console
kubectl apply -f sa-logic-deployment.yaml
```
<pre>
deployment.extensions/sa-logic created
</pre>

```console
kubectl get pods
```
<pre>
NAME                           READY   STATUS    RESTARTS   AGE
sa-frontend-5c5ddf5bfd-kqcb2   1/1     Running   0          8m34s
sa-frontend-5c5ddf5bfd-wf2bm   1/1     Running   0          8m34s
sa-logic-69bf544fb8-5xw9x      1/1     Running   0          26s
sa-logic-69bf544fb8-bfbvk      1/1     Running   0          26s
sa-webapp-648477769-fwcst      1/1     Running   0          12m
sa-webapp-648477769-j99wb      1/1     Running   0          12m
</pre>

```console
kubectl apply -f service-sa-logic.yaml
```
<pre>
service/sa-logic created
</pre>

```console
kubectl get svc
```
<pre>
NAME             TYPE           CLUSTER-IP     EXTERNAL-IP     PORT(S)        AGE
sa-frontend-lb   LoadBalancer   10.0.55.106    168.63.46.17    80:30502/TCP   37m
sa-logic         ClusterIP      10.0.183.165   <none>          80/TCP         26s
sa-webapp-lb     LoadBalancer   10.0.146.185   13.69.139.248   80:31140/TCP   17m
</pre>

```console
kubectl run -i --tty --rm debug --image=busybox --restart=Never -- sh
```
<pre>
# nslookup sa-logic
Server:         10.0.0.10
Address:        10.0.0.10:53

Name:   sa-logic.default.svc.cluster.local
Address: 10.0.183.165


# nslookup sa-webapp-lb
Server:         10.0.0.10
Address:        10.0.0.10:53

Name:   sa-webapp-lb.default.svc.cluster.local
Address: 10.0.146.185

# nslookup sa-webapp-lb
Server:         10.0.0.10
Address:        10.0.0.10:53

Name:   sa-webapp-lb.default.svc.cluster.local
Address: 10.0.146.185

</pre>

![Our application in Kuberenetes](architecture-services.png)


### TODO rolling updates 