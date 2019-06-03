pour installer les dependances, dans le repertoire ou se trouve composer;json, faire:
~~~~
composer install
~~~~

pour tester l'api
api tres simple. marche bien avec les phrases en anglais
en français il y aura des erreurs avec les caracteres spéciaux

~~~~
curl --request POST   --url http://localhost:7000/api/countwords   --header 'content-type: application/jon'   --data '{
    "pricePerWord": 0.5,
    "source": "gros gros test de malade"
}'
~~~~

