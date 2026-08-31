# F06 — Delete Todo

## Objective
Allow a user to remove an existing Todo.

## User Stories

### US-01
**Given** an existing Todo is present  
**When** the user performs the delete action  
**Then** the Todo is removed according to the application's established deletion behavior.

### US-02
**Given** a Todo has been deleted  
**When** the list is displayed  
**Then** the deleted Todo is no longer displayed.

### US-03
**Given** a delete action targets a missing Todo  
**When** the operation is processed  
**Then** the application handles it according to existing project conventions without corrupting other data.

## Scope
- Implement deletion only.
- Do not invent soft-delete behavior, confirmation UX, authorization, or undo behavior unless the project/spec explicitly establishes it.
- Add focused automated tests.

## Input → Validation → Process → Output
- **Input:** Target Todo identifier and delete action.
- **Validation:** Confirm the target and any existing deletion constraints.
- **Process:** Delete according to the established domain behavior.
- **Output:** Record is gone and list/UI no longer shows it.

## Completion Gate
Test successful deletion, resulting list state, and missing-target behavior. Then commit, merge, push, mark F06 complete, and continue.
