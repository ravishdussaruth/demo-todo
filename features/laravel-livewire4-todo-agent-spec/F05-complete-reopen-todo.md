# F05 — Complete / Reopen Todo

## Objective
Allow a Todo to transition between its incomplete and completed states.

## User Stories

### US-01
**Given** an incomplete Todo exists  
**When** the user marks it complete  
**Then** the Todo is persisted as completed and the UI reflects the new state.

### US-02
**Given** a completed Todo exists  
**When** the user reopens it  
**Then** the Todo is persisted as incomplete and the UI reflects the new state.

### US-03
**Given** the completion action is triggered  
**When** the operation is processed  
**Then** only the intended Todo state changes.

## Scope
- Implement completion/reopening using the project's actual data model and conventions.
- Do not invent additional lifecycle states.
- Test both transitions and persistence.
- Verify the Livewire interaction.

## Input → Validation → Process → Output
- **Input:** Target Todo and requested state transition.
- **Validation:** Confirm target is valid and the requested transition is supported by the established model.
- **Process:** Persist the state change.
- **Output:** Correct persisted state and UI state.

## Completion Gate
Test incomplete→complete, complete→incomplete, invalid/missing target handling if applicable, persistence, and output. Then commit, merge, push, mark F05 complete, and continue.
