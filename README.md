# Local development

From the repository root:

```bash
# One-time setup
ssh-keygen -t ed25519 -N '' -f keys/id_rsa

# Build containers, install WordPress/dependencies, and compile assets
make coffee

# Run production dependency audits, JS/PHP tests, and coding standards
make test

# Verify the production build
make build-prod
```

Then visit <https://localhost> and accept the self-signed certificate.

Stop everything with:

```bash
make stop
```
