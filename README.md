# Simpel bokning

## Reset

```bash
docker compose down && docker volume rm $(docker volume ls -q) && docker compose up -d
```

## db

```bash
docker exec -it tennisbokning-db-1 /bin/bash
```

## wpcli
    
```bash
docker exec -it tennisbokning-wpcli-1 /bin/bash
```

## Console

```bash
docker logs --follow tennisbokning-wordpress-1
```
