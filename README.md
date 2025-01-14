This repository contains the source files needed to follow the series [Kubernetes and everything else](https://rinormaloku.com/series/kubernetes-and-everything-else/) or summarized as an article in [Learn Kubernetes in Under 3 Hours: A Detailed Guide to Orchestrating Containers](https://medium.freecodecamp.org/learn-kubernetes-in-under-3-hours-a-detailed-guide-to-orchestrating-containers-114ff420e882)

To learn more about Kubernetes and other related topics check the following examples with the **Sentiment Analysis** application:

* [Kubernetes Volumes in Practice](https://rinormaloku.com/kubernetes-volumes-in-practice/):
* [Ingress Controller - simplified routing in Kubernetes](https://www.orange-networks.com/blogs/210-ingress-controller-simplified-routing-in-kubernetes)
* [Docker Compose in Practice](https://github.com/rinormaloku/k8s-mastery/tree/docker-compose)
* [Istio around everything else series](https://rinormaloku.com/series/istio-around-everything-else/)
* [Simple CI/CD for Kubernetes with Azure DevOps](https://www.orange-networks.com/blogs/224-azure-devops-ci-cd-pipeline-to-deploy-to-kubernetes)
* Envoy series - to be added!





Testing in play with docker sandbox

### Run logic	
```console
docker run -d -p 5000:5000 djkormo/sentiment-analysis-logic
```

#### testing from curl

```console
curl http://localhost:5000/analyse/sentiment -X POST --header "Content-Type: application/json"  -d '{"sentence": "I love to drink beer"}'

curl http://localhost:5000/analyse/sentiment -X POST --header "Content-Type: application/json"  -d '{"sentence": "I hate my life"}'
```

#### run webapp

```console
docker run -d -p 8080:8080 -e SA_LOGIC_API_URL='http://ip172-18-0-13-bkkt6dpt0o8g009t5rr0-5000.direct.labs.play-with-docker.com/' djkormo/sentiment-analysis-web-app	
```


##### testing from curl

```console
curl http://localhost:8080/sentiment/ -X POST  --header "Content-Type: application/json"  -d '{"sentence": "I love yogobella"}'

curl http://localhost:8080/sentiment/ -X POST  --header "Content-Type: application/json"  -d '{"sentence": "I hate my mother"}'
```

#### run frontend 
```console

docker run -d -p 80:80  -e SA_WEBAPP_API_URL='http://localhost:8000/sentiment/' djkormo/sentiment-analysis-frontend-php
``` 