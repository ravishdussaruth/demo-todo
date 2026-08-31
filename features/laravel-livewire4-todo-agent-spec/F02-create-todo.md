# F02 — Create Todo

## Objective
Allow a user to create a Todo through the Livewire 4 application.

## User Stories

### US-01
**Given** the create-Todo interface is available  
**When** a user submits valid Todo data  
**Then** the Todo is persisted and the UI reflects the successful creation.

### US-02
**Given** a user submits invalid or incomplete data  
**When** the create action is processed  
**Then** validation prevents invalid persistence and the appropriate validation state is exposed to the UI.

### US-03
**Given** a create request is processed  
**When** the input passes validation  
**Then** the application performs the create operation using the established Todo domain conventions.

## Scope
- Implement only Todo creation.
- Follow the actual project's Livewire 4 component/view conventions after inspection.
- Do not invent extra fields, statuses, priorities, tags, due dates, or behavior not established by the repository/specification.
- Add focused automated tests.

## Input → Validation → Process → Output
- **Input:** User-entered Todo fields defined by the inspected domain/spec.
- **Validation:** Verify required fields and all applicable constraints actually established by the application.
- **Process:** Persist a valid Todo.
- **Output:** Successful UI state and persisted record; invalid input produces validation errors and no invalid record.

## Completion Gate
Test valid input, invalid input, persistence, and UI output. Review against every scenario. Then commit, merge into local `main`, push `main`, mark F02 complete, and continue.
