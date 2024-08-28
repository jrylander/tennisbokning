# Simpel bokning

## Reset

```bash
docker compose down && docker volume rm $(docker volume ls -q) && docker compose up -d
```

## Console

```bash
docker logs --follow tennisbokning-wordpress-1
```
