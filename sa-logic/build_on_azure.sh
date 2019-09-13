#!/bin/bash

# build_on_azure.bash -o build -n acr-123 -g rg-aks-simple

# build_on_azure.bash -o rebuild -n acr-123 -g rg-aks-simple

# build_on_azure.bash -o delete -n acr-123 -g rg-aks-simple

while getopts n:g:o: option
do
case "${option}"
in
n) ACR_NAME=${OPTARG};;
g) ACR_RG=${OPTARG};;
o) OPERATION=${OPTARG};;
esac
done


if [ -z "$OPERATION" ]
then
      echo "\$OPERATION is empty"
else
      echo "\$OPERATION is NOT empty"
fi

if [ -z "$ACR_NAME" ]
then
      echo "\$ACR_NAME is empty"
else
      echo "\$ACR_NAME is NOT empty"
fi

if [ -z "$ACR_RG" ]
then
      echo "\$ACR_RG is empty"
else
      echo "\$ACR_RG is NOT empty"
fi

echo "OPERATION: $OPERATION"
echo "AKS_NAME: $AKS_NAME"
echo "AKS_RG: $AKS_RG"

if [ "$OPERATION" = "build" ] ;
then
echo "Building image...";
az acr build --registry $ACR_NAME --image sa-logic:v1 .
fi

if [ "$OPERATION" = "rebuild" ] ;
then
echo "Rebuilding image...";
az acr repository delete --name $ACR_NAME --repository sa-logic:v1
az acr build --registry $ACR_NAME --image sa-logic:v1 .
fi


if [ "$OPERATION" = "delete" ] ;
then
echo "deleting  image...";
az acr repository delete --name $ACR_NAME --repository sa-logic:v1
fi


# budujemy obraz kontenerowy  na podstawie zawartości pliku Dockerfile



# lista zbudowanych obrazów
az acr repository list --name $ACR_NAME --output table
	
		
# szczegoly 
az acr repository show -n $ACR_NAME -t sa-logic:v1