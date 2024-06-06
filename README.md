# Start project

```bash
    docker-compose up -d
```

# TODO

page de soumission du feedback:

- un formulaire
  - nom (obligatoire)
  - email (obligatoire, format valide)
  - message (obligatoire)
  - note (/5)
- un bouton pour soumettre le formulaire

validation des données:

- vérification côté client pour s'assurer que tous les champs obligatoires sont remplis
- Vérification côté serveur pour valider les données avant de les insérer dans la base de données

stockage des feedbacks:

- stockage des feedbacks dans une base de données MySQL
