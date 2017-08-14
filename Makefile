info:
	@echo "Usage: make install|update|test"

# pass any target to composer
$(MAKECMDGOALS):
	composer $(MAKECMDGOALS)
