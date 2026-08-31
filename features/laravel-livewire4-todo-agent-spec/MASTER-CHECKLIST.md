# Laravel + Livewire 4 Todo App — Master Checklist

## Operating Rules

- [ ] Work autonomously; do not ask for routine confirmation.
- [ ] Never assume or guess requirements, framework APIs, existing project structure, database schema, routes, component names, or UI behavior.
- [ ] Before implementing any feature:
  - [ ] Read the feature file completely.
  - [ ] Inspect the existing codebase and relevant Laravel/Livewire 4 APIs/documentation when needed.
  - [ ] Identify dependencies and constraints.
  - [ ] Create a short implementation plan before editing code.
  - [ ] Implement only the feature's stated scope.
  - [ ] Review the resulting code against every user story and acceptance scenario.
- [ ] For every feature, test the complete flow: **input → validation → process → output**.
- [ ] Do not mark a feature complete until its tests pass and the acceptance scenarios have been verified.
- [ ] After successful testing and review:
  - [ ] Commit the feature on its feature branch.
  - [ ] Merge the feature branch into local `main`.
  - [ ] Push `main` to GitHub.
  - [ ] Do not develop the feature directly on `main`.
- [ ] Then mark the feature completed and move to the next unchecked feature.
- [ ] If a test fails, keep the feature incomplete, diagnose/fix it on the feature branch, and retest.
- [ ] Do not mark a feature complete merely because the code was written.
- [ ] Keep commits focused on one feature.
- [ ] Before destructive Git operations, verify the current branch, working tree, remotes, and merge state.

## Feature Progression

- [x] F01 — Project Baseline & Todo Domain
- [x] F02 — Create Todo
- [x] F03 — List & View Todos
- [x] F04 — Edit Todo
- [x] F05 — Complete / Reopen Todo
- [x] F06 — Delete Todo
- [x] F07 — Filtering & Basic Search
- [x] F08 — Validation, Error States & UX Hardening
- [ ] F09 — Automated Test Suite & Regression Pass
- [ ] F10 — Final Integration, Documentation & Release Check

## Definition of Done — Every Feature

- [ ] User stories reviewed.
- [ ] Given/When/Then scenarios reviewed.
- [ ] Existing implementation inspected.
- [ ] Dependencies identified.
- [ ] Implementation plan written before coding.
- [ ] Code implemented.
- [ ] Code reviewed against the feature specification.
- [ ] Input tested.
- [ ] Validation tested where applicable.
- [ ] Processing/business behavior tested.
- [ ] Output/UI/database behavior tested.
- [ ] Relevant automated tests added/updated.
- [ ] Relevant tests pass.
- [ ] No unrelated changes introduced.
- [ ] Feature branch contains the completed work.
- [ ] Feature committed.
- [ ] Feature branch merged into local `main`.
- [ ] `main` pushed to GitHub.
- [ ] Feature checkbox marked complete.
- [ ] Proceed to next feature.

## Git Workflow

For each feature:

1. Start from an up-to-date local `main`.
2. Create a dedicated feature branch, e.g. `feature/f02-create-todo`.
3. Implement and test only that feature on the feature branch.
4. Review the diff and tests.
5. Commit only after the feature satisfies its Definition of Done.
6. Switch to local `main` and merge the feature branch.
7. Push local `main` to the configured GitHub remote.
8. Return to the master checklist and mark the feature complete.
9. Start the next feature from the updated `main`.

Do not push an incomplete feature to `main`.
