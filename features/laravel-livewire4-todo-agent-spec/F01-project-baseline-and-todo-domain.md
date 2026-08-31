# F01 — Project Baseline & Todo Domain

## Objective
Establish the smallest verified foundation for the Todo application without inventing requirements.

## User Stories

### US-01
**Given** a Laravel application using Livewire 4 is available  
**When** the agent inspects the project  
**Then** it identifies the actual Laravel version, Livewire version, application structure, configured database, existing routes, tests, and relevant conventions before making changes.

### US-02
**Given** the project does not already contain a suitable Todo domain implementation  
**When** the Todo domain foundation is created  
**Then** it contains only the database/model structure required by the later Todo features, based on explicit requirements in this feature set and verified Laravel conventions.

### US-03
**Given** migrations and model code are created or changed  
**When** the relevant database/model tests are run  
**Then** the foundation works against the project's configured environment without relying on guessed configuration.

## Scope
- Inspect before changing anything.
- Establish the Todo persistence foundation needed by F02–F06.
- Use Laravel conventions and the project's existing conventions.
- Add focused tests for the foundation.
- Do not add UI features yet.

## Input → Validation → Process → Output
- **Input:** Existing Laravel/Livewire 4 project and current repository state.
- **Validation:** Confirm versions, configuration, existing domain objects, migrations, routes, and test setup from the repository/runtime.
- **Process:** Plan, implement the minimum required domain foundation, then review.
- **Output:** Verified Todo domain foundation and passing focused tests.

## Completion Gate
All user stories and Definition of Done pass. Then commit, merge into local `main`, push `main`, mark F01 complete, and continue to F02.
