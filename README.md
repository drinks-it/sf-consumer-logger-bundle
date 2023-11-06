
# Start

## 1. Install

```bash
compsoer require drinks-it/sf-consumer-logger-bundle
```

## Configuration

```yaml
# config/packages/sf_consumer_logger.yaml

sf_consumer_logger:
    on_start: info
    on_start_message: 'Consumer started'
    on_running: null # off logs when consumer running
    on_running_message: 'Consumer running'
    on_stop: info
    on_stop_message: 'Consumer stopped'
```
