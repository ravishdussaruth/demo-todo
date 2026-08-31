# F04 — Edit Todo

## Objective
Allow an existing Todo to be edited through the Livewire 4 UI.

## User Stories

### US-01
**Given** an existing Todo is available  
**When** the user submits valid changed data  
**Then** the Todo is updated with the submitted values.

### US-02
**Given** an existing Todo is being edited  
**When** invalid data is submitted  
**Then** validation prevents invalid updates and exposes the relevant validation state.

### US-03
**Given** a Todo does not exist  
**When** an edit operation targets that Todo  
**Then** the application handles the missing record according to the project's established error conventions rather than failing unexpectedly.

## Scope
- Implement edit/update only.
- Reuse the domain validation rules where appropriate.
- Inspect the existing project for established missing-record and UI patterns.
- Add focused automated tests.

## Input → Validation → Process → Output
- **Input:** Existing Todo identifier plus edited fields.
- **Validation:** Confirm target exists and submitted fields satisfy the established rules.
- **Process:** Update the persisted Todo.
- **Output:** Updated data is persisted and reflected in the UI; invalid/missing targets are handled correctly.

## Completion Gate
Test successful update, validation failure, persistence, UI output, and missing-record behavior. Then commit, merge, push, mark F04 complete, and continue.
