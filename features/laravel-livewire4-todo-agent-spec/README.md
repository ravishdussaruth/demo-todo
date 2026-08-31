# Todo App Agent Specification

This package contains a master execution checklist plus one independent Markdown specification per feature.

## Intended use

Give the entire folder to Claude Code Agent as the working specification. The agent should:

1. Follow `MASTER-CHECKLIST.md`.
2. Process features in order.
3. Work on a dedicated feature branch.
4. Inspect and plan before coding.
5. Implement and review against every Given/When/Then scenario.
6. Test the complete **input → validation → process → output** flow.
7. Only after successful testing, commit, merge into local `main`, and push `main` to GitHub.
8. Mark the feature complete and proceed to the next feature.

The feature files deliberately avoid guessing project-specific fields, routes, UI conventions, authorization rules, pagination, or other behavior. The agent must inspect the actual repository and establish those details from verified project requirements and existing code.
