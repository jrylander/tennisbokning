# Simpel bokning

## Reset

```bash
docker compose down && docker volume rm $(docker volume ls -q) && docker compose up -d
```

## wpcli
    
    ```bash
    docker exec tennisbokning-wpcli-1 wp --info
    ```

## Console

```bash
docker logs --follow tennisbokning-wordpress-1
```
